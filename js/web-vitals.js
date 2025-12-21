/**
 * Core Web Vitals Monitoring
 * Tracks LCP, FID, CLS and sends to analytics
 * 
 * Include this script on all pages:
 * <script src="/js/web-vitals.js" defer></script>
 */

(function() {
    'use strict';
    
    // Configuration
    const config = {
        endpoint: '/api/metrics',  // Your analytics endpoint
        sendToGA: true,            // Send to Google Analytics if available
        debug: false               // Console logging
    };
    
    // Store metrics
    const metrics = {
        lcp: null,
        fid: null,
        cls: null,
        ttfb: null
    };
    
    /**
     * Send metric to analytics
     */
    function sendMetric(name, value, rating) {
        const data = {
            name: name,
            value: value,
            rating: rating,
            url: window.location.pathname,
            timestamp: Date.now()
        };
        
        if (config.debug) {
            console.log('Web Vital:', data);
        }
        
        // Send to Google Analytics (if available)
        if (config.sendToGA && typeof gtag === 'function') {
            gtag('event', name, {
                event_category: 'Web Vitals',
                value: Math.round(value),
                event_label: rating,
                non_interaction: true,
            });
        }
        
        // Send to custom endpoint
        if (navigator.sendBeacon) {
            navigator.sendBeacon(config.endpoint, JSON.stringify(data));
        } else {
            fetch(config.endpoint, {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {'Content-Type': 'application/json'},
                keepalive: true
            }).catch(function(err) {
                if (config.debug) console.error('Failed to send metric:', err);
            });
        }
    }
    
    /**
     * Get rating based on thresholds
     */
    function getRating(name, value) {
        const thresholds = {
            lcp: { good: 2500, poor: 4000 },
            fid: { good: 100, poor: 300 },
            cls: { good: 0.1, poor: 0.25 },
            ttfb: { good: 800, poor: 1800 }
        };
        
        const t = thresholds[name];
        if (!t) return 'unknown';
        
        if (value <= t.good) return 'good';
        if (value <= t.poor) return 'needs-improvement';
        return 'poor';
    }
    
    /**
     * Largest Contentful Paint (LCP)
     */
    function observeLCP() {
        if (!('PerformanceObserver' in window)) return;
        
        try {
            const observer = new PerformanceObserver(function(list) {
                const entries = list.getEntries();
                const lastEntry = entries[entries.length - 1];
                const lcp = lastEntry.renderTime || lastEntry.loadTime;
                
                metrics.lcp = lcp;
                sendMetric('LCP', lcp, getRating('lcp', lcp));
            });
            
            observer.observe({ type: 'largest-contentful-paint', buffered: true });
        } catch (e) {
            if (config.debug) console.error('LCP observation failed:', e);
        }
    }
    
    /**
     * First Input Delay (FID)
     */
    function observeFID() {
        if (!('PerformanceObserver' in window)) return;
        
        try {
            const observer = new PerformanceObserver(function(list) {
                const entries = list.getEntries();
                entries.forEach(function(entry) {
                    const fid = entry.processingStart - entry.startTime;
                    metrics.fid = fid;
                    sendMetric('FID', fid, getRating('fid', fid));
                });
            });
            
            observer.observe({ type: 'first-input', buffered: true });
        } catch (e) {
            if (config.debug) console.error('FID observation failed:', e);
        }
    }
    
    /**
     * Cumulative Layout Shift (CLS)
     */
    function observeCLS() {
        if (!('PerformanceObserver' in window)) return;
        
        let clsValue = 0;
        let sessionValue = 0;
        let sessionEntries = [];
        
        try {
            const observer = new PerformanceObserver(function(list) {
                list.getEntries().forEach(function(entry) {
                    if (!entry.hadRecentInput) {
                        const firstSessionEntry = sessionEntries[0];
                        const lastSessionEntry = sessionEntries[sessionEntries.length - 1];
                        
                        if (sessionValue && 
                            entry.startTime - lastSessionEntry.startTime < 1000 &&
                            entry.startTime - firstSessionEntry.startTime < 5000) {
                            sessionValue += entry.value;
                            sessionEntries.push(entry);
                        } else {
                            sessionValue = entry.value;
                            sessionEntries = [entry];
                        }
                        
                        if (sessionValue > clsValue) {
                            clsValue = sessionValue;
                            metrics.cls = clsValue;
                            sendMetric('CLS', clsValue, getRating('cls', clsValue));
                        }
                    }
                });
            });
            
            observer.observe({ type: 'layout-shift', buffered: true });
        } catch (e) {
            if (config.debug) console.error('CLS observation failed:', e);
        }
    }
    
    /**
     * Time to First Byte (TTFB)
     */
    function measureTTFB() {
        if (!window.performance || !window.performance.timing) return;
        
        try {
            const timing = window.performance.timing;
            const ttfb = timing.responseStart - timing.requestStart;
            
            metrics.ttfb = ttfb;
            sendMetric('TTFB', ttfb, getRating('ttfb', ttfb));
        } catch (e) {
            if (config.debug) console.error('TTFB measurement failed:', e);
        }
    }
    
    /**
     * Initialize monitoring
     */
    function init() {
        // Wait for page to be fully loaded
        if (document.readyState === 'complete') {
            startMonitoring();
        } else {
            window.addEventListener('load', startMonitoring);
        }
    }
    
    function startMonitoring() {
        observeLCP();
        observeFID();
        observeCLS();
        measureTTFB();
        
        // Report all metrics before page unload
        window.addEventListener('beforeunload', function() {
            if (config.debug) {
                console.log('Final Web Vitals:', metrics);
            }
        });
    }
    
    // Start monitoring
    init();
})();
