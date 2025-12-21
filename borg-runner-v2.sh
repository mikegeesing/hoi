#!/bin/bash
set -euo pipefail

export BORG_REPO="/backups"
export BORG_PASSPHRASE="H@@ksbergen023!"
export BORG_CACHE_DIR="/var/lib/borg-cache"
export BORG_TMPDIR="/var/tmp/borg"

CMD="${1:-}"

case "$CMD" in

  list)
    exec /usr/bin/borg list --json "$BORG_REPO"
    ;;

  list-files)
    ARCHIVE="${2:-}"
    PATH_IN_ARCHIVE="${3:-}"

    [[ "$ARCHIVE" =~ ^[a-zA-Z0-9._:-]+$ ]] || exit 10
    [[ "$PATH_IN_ARCHIVE" != *".."* ]] || exit 11

    exec /usr/bin/borg list "$BORG_REPO::$ARCHIVE" "$PATH_IN_ARCHIVE"
    ;;

  extract-multi)
    # New mode for extracting multiple files with working directory
    # Usage: borg-runner.sh extract-multi <archive> [file1] [file2] ...
    # Run from the target directory as CWD
    ARCHIVE="${2:-}"
    
    [[ "$ARCHIVE" =~ ^[a-zA-Z0-9._:-]+$ ]] || exit 20
    
    # Validate we're in a safe directory (must be under /home/ or /tmp/)
    CWD="$(pwd)"
    if [[ ! "$CWD" =~ ^/home/ ]] && [[ ! "$CWD" =~ ^/tmp/ ]] && [[ "$CWD" != "/" ]]; then
        echo "Error: Working directory must be under /home/, /tmp/ or root" >&2
        exit 21
    fi
    
    # Shift to get the file arguments
    shift 2
    
    # Validate all file paths don't contain ..
    for FILE in "$@"; do
        if [[ "$FILE" == *".."* ]]; then
            echo "Error: Path cannot contain .." >&2
            exit 22
        fi
        # Allow paths starting with 'home/' (relative in archive)
        if [[ ! "$FILE" =~ ^home/ ]]; then
            echo "Error: File paths must start with 'home/'" >&2
            exit 23
        fi
    done
    
    # Execute borg extract
    exec /usr/bin/borg extract "$BORG_REPO::$ARCHIVE" -- "$@"
    ;;

  *)
    echo "Invalid command. Use: list, list-files, or extract-multi"
    exit 1
    ;;
esac
