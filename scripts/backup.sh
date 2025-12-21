#!/bin/bash
#
# Automated Backup Script for OnlineHoster.nl
# Creates incremental backups with rotation
#
# Usage: ./backup.sh
# Cron: 0 2 * * * /home/onlineh/domains/onlinehoster.nl/public_html/scripts/backup.sh
#

set -e  # Exit on error

# Configuration
BACKUP_DIR="/home/onlineh/backups"
WEB_ROOT="/home/onlineh/domains/onlinehoster.nl/public_html"
DATE=$(date +"%Y%m%d_%H%M%S")
RETENTION_DAYS=30
LOG_FILE="/var/log/backup.log"

# Database Configuration (load from .env if exists)
if [ -f "$WEB_ROOT/.env" ]; then
    source "$WEB_ROOT/.env"
fi

DB_HOST="${DB_HOST:-localhost}"
DB_NAME="${DB_NAME:-onlinehoster_db}"
DB_USER="${DB_USERNAME:-root}"
DB_PASS="${DB_PASSWORD}"

# Function: Log message
log() {
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] $1" | tee -a "$LOG_FILE"
}

# Function: Check disk space
check_disk_space() {
    local required_mb=1000
    local available_mb=$(df -m "$BACKUP_DIR" | awk 'NR==2 {print $4}')
    
    if [ "$available_mb" -lt "$required_mb" ]; then
        log "ERROR: Insufficient disk space. Required: ${required_mb}MB, Available: ${available_mb}MB"
        exit 1
    fi
}

# Function: Create backup directory
create_backup_dir() {
    if [ ! -d "$BACKUP_DIR" ]; then
        mkdir -p "$BACKUP_DIR"
        log "Created backup directory: $BACKUP_DIR"
    fi
}

# Function: Backup database
backup_database() {
    log "Starting database backup..."
    
    local db_backup="$BACKUP_DIR/db_backup_$DATE.sql"
    
    if [ -z "$DB_PASS" ]; then
        log "WARNING: No database password configured, skipping database backup"
        return 0
    fi
    
    if mysqldump -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" > "$db_backup" 2>/dev/null; then
        gzip "$db_backup"
        log "Database backup completed: ${db_backup}.gz"
        log "Database size: $(du -h ${db_backup}.gz | cut -f1)"
    else
        log "ERROR: Database backup failed"
        return 1
    fi
}

# Function: Backup files
backup_files() {
    log "Starting files backup..."
    
    local file_backup="$BACKUP_DIR/files_backup_$DATE.tar.gz"
    
    # Exclude certain directories
    tar -czf "$file_backup" \
        --exclude="$WEB_ROOT/templates_c" \
        --exclude="$WEB_ROOT/backups" \
        --exclude="$WEB_ROOT/.git" \
        --exclude="$WEB_ROOT/tmp" \
        --exclude="$WEB_ROOT/cache" \
        -C "$(dirname $WEB_ROOT)" \
        "$(basename $WEB_ROOT)" 2>/dev/null
    
    if [ $? -eq 0 ]; then
        log "Files backup completed: $file_backup"
        log "Backup size: $(du -h $file_backup | cut -f1)"
    else
        log "ERROR: Files backup failed"
        return 1
    fi
}

# Function: Cleanup old backups
cleanup_old_backups() {
    log "Cleaning up old backups (retention: $RETENTION_DAYS days)..."
    
    local deleted_count=0
    
    # Delete old database backups
    find "$BACKUP_DIR" -name "db_backup_*.sql.gz" -mtime +$RETENTION_DAYS -type f -delete -print | while read file; do
        log "Deleted old database backup: $(basename $file)"
        ((deleted_count++))
    done
    
    # Delete old file backups
    find "$BACKUP_DIR" -name "files_backup_*.tar.gz" -mtime +$RETENTION_DAYS -type f -delete -print | while read file; do
        log "Deleted old file backup: $(basename $file)"
        ((deleted_count++))
    done
    
    if [ $deleted_count -gt 0 ]; then
        log "Cleaned up $deleted_count old backup(s)"
    else
        log "No old backups to clean up"
    fi
}

# Function: Verify backup integrity
verify_backup() {
    log "Verifying backup integrity..."
    
    local latest_db=$(ls -t $BACKUP_DIR/db_backup_*.sql.gz 2>/dev/null | head -1)
    local latest_files=$(ls -t $BACKUP_DIR/files_backup_*.tar.gz 2>/dev/null | head -1)
    
    local errors=0
    
    # Verify database backup
    if [ -f "$latest_db" ]; then
        if gzip -t "$latest_db" 2>/dev/null; then
            log "Database backup integrity: OK"
        else
            log "ERROR: Database backup corrupted: $latest_db"
            ((errors++))
        fi
    fi
    
    # Verify files backup
    if [ -f "$latest_files" ]; then
        if tar -tzf "$latest_files" >/dev/null 2>&1; then
            log "Files backup integrity: OK"
        else
            log "ERROR: Files backup corrupted: $latest_files"
            ((errors++))
        fi
    fi
    
    return $errors
}

# Function: Send notification
send_notification() {
    local status=$1
    local message=$2
    
    # You can customize this to send email notifications
    # Example: echo "$message" | mail -s "Backup $status" admin@onlinehoster.nl
    
    log "Backup $status: $message"
}

# Main execution
main() {
    log "=========================================="
    log "Starting backup process..."
    log "=========================================="
    
    # Pre-checks
    check_disk_space
    create_backup_dir
    
    # Perform backups
    local backup_status="SUCCESS"
    
    if ! backup_database; then
        backup_status="PARTIAL"
    fi
    
    if ! backup_files; then
        backup_status="FAILED"
    fi
    
    # Post-backup tasks
    cleanup_old_backups
    
    if ! verify_backup; then
        backup_status="FAILED"
    fi
    
    # Summary
    log "=========================================="
    log "Backup completed with status: $backup_status"
    log "Total backup size: $(du -sh $BACKUP_DIR | cut -f1)"
    log "=========================================="
    
    # Send notification
    send_notification "$backup_status" "Backup completed at $(date)"
    
    # Exit with appropriate code
    if [ "$backup_status" = "FAILED" ]; then
        exit 1
    else
        exit 0
    fi
}

# Run main function
main
