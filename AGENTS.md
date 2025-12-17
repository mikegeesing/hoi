# AGENTS.md - AI Agent Guide for HOI (Borg Restore Portal)

This document provides essential information for AI coding agents working with the HOI codebase.

## Project Overview

HOI is a **Laravel-based web portal for restoring files from BorgBackup archives**. It provides:
- Token-based authentication for restore operations
- Archive browsing and file navigation
- Calendar view of available snapshots
- Background restore jobs with status tracking
- Admin token management

## Tech Stack

- **Framework**: Laravel (PHP)
- **Backup Tool**: BorgBackup (external binary)
- **Frontend**: Blade templates (Laravel templating engine)
- **Job Queue**: Laravel Queue system for background restore operations
- **Database**: Laravel ORM (Eloquent) with migrations

## Key Architecture

### Core Services

1. **BorgService** (`app/Services/BorgService.php`)
   - Main service for interacting with Borg CLI
   - Methods: `listArchives()`, `listFiles()`, `detectArchiveType()`

2. **BorgWrapperService** (`app/Services/BorgWrapperService.php`)
   - Wrapper around Borg commands with repository/passphrase management
   - Registered as singleton in AppServiceProvider
   - Methods: `archivesContainingPath()`

3. **RestoreController** (`app/Http/Controllers/RestoreController.php`)
   - Main controller handling all restore portal routes
   - Token validation and usage tracking
   - Job creation and status monitoring

### Models

- **RestoreToken**: Manages restore access tokens with expiry and usage limits
- **RestoreJob**: Tracks restore job status, files, and output logs

### Jobs

- **BorgRestoreJob** (`app/Jobs/BorgRestoreJob.php`): Background job for executing actual restore operations

## Configuration

### Environment Variables

Required in `.env`:
```
BORG_REPOSITORY=/path/to/borg/repository
BORG_PASSPHRASE=your_passphrase
```

Configured in `config/services.php` under the `borg` key.

### Service Registration

BorgWrapperService is registered as singleton in `AppServiceProvider::register()` to ensure consistent repository/passphrase configuration.

## Development Guidelines

### Code Style

- Follow Laravel conventions and PSR-12 standards
- Use dependency injection for services
- Leverage Eloquent ORM for database operations
- Use `Log::error()` and `Log::warning()` for debugging

### Token Validation Pattern

Always validate tokens using the private `validateTokenOnly()` method:
```php
$token = $this->validateTokenOnly($rawToken);
if (! $token) {
    return response()->json(['error' => 'Token ongeldig'], 403);
}
```

### Database Transactions for Token Usage

When creating restore jobs, use `DB::transaction()` with `lockForUpdate()` to prevent race conditions:
```php
DB::transaction(function () use ($token) {
    $t = RestoreToken::where('id', $token->id)->lockForUpdate()->first();
    $t->used++;
    $t->save();
});
```

### File Path Handling

- Default initial path for file browser: `/home/onlineho`
- Normalize service return values (arrays vs structured objects)
- Validate archive existence before creating restore jobs

## Testing

### Manual Testing Requirements

1. Set up test Borg repository with sample archives
2. Create restore tokens via admin interface
3. Test token expiry and usage limits
4. Verify background job execution

### Key Test Scenarios

- Token validation (valid, expired, exceeded usage)
- Archive listing and file browsing
- Calendar filtering by path/files
- Restore job creation and status updates
- Concurrent token usage (race condition prevention)

## Common Tasks

### Adding New Routes

Routes are defined in Laravel route files (likely `routes/web.php`). Follow RESTful conventions:
- Archive views: GET requests
- Job creation: POST requests with JSON payloads
- Status checks: GET with job ID parameter

### Extending Borg Functionality

Add new methods to `BorgService` or `BorgWrapperService`:
1. Execute Borg CLI commands using Laravel's `Process` facade or `exec()`
2. Parse JSON output from Borg (use `--json` flag)
3. Handle errors and log appropriately

### Database Changes

1. Create migration: `php artisan make:migration create_table_name`
2. Update models with new attributes/relationships
3. Test migration rollback capability

## Deployment

### Prerequisites

- PHP 8.1+ with required extensions
- Composer for dependency management
- Borg binary installed and accessible in PATH
- Configured queue worker for background jobs
- Web server (Apache/Nginx) with PHP-FPM

### Deployment Steps

1. Clone repository
2. `composer install --no-dev`
3. Configure `.env` with Borg credentials
4. Run migrations: `php artisan migrate`
5. Start queue worker: `php artisan queue:work`
6. Configure web server to point to `public/` directory

## Troubleshooting

### Common Issues

1. **"Kan bestanden niet laden"**: Check Borg repository path and passphrase
2. **Job stuck in "pending"**: Ensure queue worker is running
3. **Token validation fails**: Verify token hasn't expired or exceeded usage limit
4. **File browser shows empty**: Verify initial path exists in archive

### Debug Mode

Enable Laravel debug mode in `.env`:
```
APP_DEBUG=true
```

Check logs in `storage/logs/laravel.log`

## Related Documentation

- [Laravel Documentation](https://laravel.com/docs)
- [BorgBackup Documentation](https://borgbackup.readthedocs.io/)
- [Laravel Queue Documentation](https://laravel.com/docs/queues)

## Notes for AI Agents

- **Language**: User-facing messages are in Dutch ("Token ongeldig", "Geen token", etc.)
- **Security**: Never expose raw tokens in logs; always hash with SHA-256
- **Performance**: Use eager loading (`with()`) to avoid N+1 queries
- **Error Handling**: Catch `\Throwable` for broad exception coverage
- **Background Jobs**: Always dispatch jobs after DB transaction commits
