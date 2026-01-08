# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- **Borg Restore Portal**: Comprehensive token-based restore portal with the following features:
  - File browser for navigating backup archives
  - Calendar view for selecting backup dates
  - Background job processing for restore operations
  - Admin token management interface
  - Job status UI for monitoring restore progress
  - Automated deploy script
  - RestoreController with archive, file browser, calendar, and job management functionalities

### Fixed
- Fixed files.blade view rendering issues

## [0.1.0] - 2023-10-19

### Added
- Initial Dockerfile for container deployment
