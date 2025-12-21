# Email Security Configuration Guide
# Configure these DNS records to improve email deliverability

## 1. SPF (Sender Policy Framework)
Prevents email spoofing by specifying authorized mail servers.

### DNS Record Type: TXT
```
Name: @
Value: v=spf1 include:_spf.google.com include:spf.protection.outlook.com ip4:YOUR_SERVER_IP ~all
TTL: 3600
```

**Explanation:**
- `v=spf1` = SPF version
- `include:_spf.google.com` = If using Google Workspace
- `include:spf.protection.outlook.com` = If using Microsoft 365
- `ip4:YOUR_SERVER_IP` = Your hosting server IP
- `~all` = Soft fail (recommended for testing)
- `-all` = Hard fail (use after testing)

### Check Current SPF:
```bash
dig TXT onlinehoster.nl | grep spf
nslookup -type=TXT onlinehoster.nl
```

---

## 2. DKIM (DomainKeys Identified Mail)
Adds digital signature to outgoing emails.

### Generate DKIM Key:
**Via cPanel:**
1. Go to Email > Email Deliverability
2. Click "Manage" next to your domain
3. Click "Install the suggested DKIM keys"
4. Copy the generated key

**Via Command Line:**
```bash
openssl genrsa -out dkim_private.pem 2048
openssl rsa -in dkim_private.pem -pubout -out dkim_public.pem
```

### DNS Record Type: TXT
```
Name: default._domainkey
Value: v=DKIM1; k=rsa; p=MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA...
TTL: 3600
```

**Note:** Replace with your actual public key (long base64 string)

### Check Current DKIM:
```bash
dig TXT default._domainkey.onlinehoster.nl
nslookup -type=TXT default._domainkey.onlinehoster.nl
```

---

## 3. DMARC (Domain-based Message Authentication)
Specifies how to handle emails that fail SPF/DKIM checks.

### DNS Record Type: TXT
```
Name: _dmarc
Value: v=DMARC1; p=quarantine; rua=mailto:dmarc-reports@onlinehoster.nl; ruf=mailto:dmarc-forensics@onlinehoster.nl; pct=100; adkim=s; aspf=s
TTL: 3600
```

**Policy Options:**
- `p=none` = Monitor only (recommended for initial setup)
- `p=quarantine` = Send failures to spam (recommended)
- `p=reject` = Reject failures completely (most strict)

**Parameters:**
- `rua` = Aggregate reports email
- `ruf` = Forensic reports email
- `pct=100` = Apply policy to 100% of emails
- `adkim=s` = Strict DKIM alignment
- `aspf=s` = Strict SPF alignment

### Check Current DMARC:
```bash
dig TXT _dmarc.onlinehoster.nl
nslookup -type=TXT _dmarc.onlinehoster.nl
```

---

## 4. MX Records (Mail Exchange)
Ensure proper mail routing.

### DNS Record Type: MX
```
Priority: 10
Name: @
Value: mail.onlinehoster.nl
TTL: 3600
```

### Check Current MX:
```bash
dig MX onlinehoster.nl
nslookup -type=MX onlinehoster.nl
```

---

## 5. Reverse DNS (PTR Record)
Must match your server's hostname.

**Contact your hosting provider to set:**
```
IP: YOUR_SERVER_IP
PTR: mail.onlinehoster.nl
```

### Check Reverse DNS:
```bash
dig -x YOUR_SERVER_IP
nslookup YOUR_SERVER_IP
```

---

## Testing & Validation

### 1. All-in-One Email Test
**MXToolbox:**
https://mxtoolbox.com/SuperTool.aspx?action=spf:onlinehoster.nl

**Google Admin Toolbox:**
https://toolbox.googleapps.com/apps/checkmx/

### 2. Send Test Email
**Mail Tester:**
1. Visit: https://www.mail-tester.com/
2. Send email to provided address
3. Check score (aim for 10/10)

### 3. DMARC Monitor
**Free Services:**
- https://dmarc.postmarkapp.com/
- https://dmarcian.com/
- https://www.valimail.com/dmarc/

---

## Implementation Checklist

### Phase 1: Setup (Week 1)
- [ ] Add SPF record with `~all` (soft fail)
- [ ] Generate and add DKIM key
- [ ] Add DMARC with `p=none` (monitor only)
- [ ] Test with mail-tester.com

### Phase 2: Monitor (Week 2-3)
- [ ] Review DMARC reports daily
- [ ] Verify SPF/DKIM pass rates
- [ ] Identify any legitimate failures
- [ ] Adjust SPF includes if needed

### Phase 3: Enforce (Week 4+)
- [ ] Update DMARC to `p=quarantine`
- [ ] Monitor for 2 weeks
- [ ] Update SPF to `-all` (hard fail)
- [ ] Consider `p=reject` if 100% pass rate

---

## Expected Impact

### Before Configuration:
- Deliverability: 60-70%
- Spam folder rate: 30-40%
- Spoofing vulnerability: High
- ISP trust: Low

### After Configuration:
- Deliverability: 95-99%
- Spam folder rate: 1-5%
- Spoofing vulnerability: Very Low
- ISP trust: High

### Benefits:
✅ Better inbox placement
✅ Protection against phishing/spoofing
✅ Improved sender reputation
✅ ISP trust and whitelisting
✅ Compliance with email standards
✅ Detailed delivery reports

---

## Common Issues & Solutions

### SPF Too Many Lookups
**Problem:** SPF record exceeds 10 DNS lookups
**Solution:** Use IP addresses instead of includes, or SPF flattening services

### DKIM Signature Mismatch
**Problem:** Email headers don't match DKIM signature
**Solution:** Ensure "From" domain matches signing domain

### DMARC Reports Not Received
**Problem:** No reports arriving
**Solution:** Check email forwarding, wait 24-48 hours for first reports

### Emails Still Going to Spam
**Problem:** SPF/DKIM pass but still spam
**Solution:** Check content, improve engagement, build sender reputation

---

## Quick Reference Commands

```bash
# Check all DNS records
dig ANY onlinehoster.nl

# Check SPF
dig TXT onlinehoster.nl | grep spf

# Check DKIM
dig TXT default._domainkey.onlinehoster.nl

# Check DMARC
dig TXT _dmarc.onlinehoster.nl

# Check MX
dig MX onlinehoster.nl

# Check Reverse DNS
dig -x YOUR_SERVER_IP

# Test email authentication
swaks --to test@gmail.com --from noreply@onlinehoster.nl --server localhost
```

---

## Resources

**Official Documentation:**
- SPF: http://www.open-spf.org/
- DKIM: http://www.dkim.org/
- DMARC: https://dmarc.org/

**Testing Tools:**
- https://mxtoolbox.com/
- https://www.mail-tester.com/
- https://toolbox.googleapps.com/
- https://dmarcian.com/

**Monitoring Services:**
- Postmark DMARC Monitoring
- DMARC Analyzer
- Valimail

---

**Last Updated:** December 21, 2025
**Status:** Ready for Implementation
