# Change Log

## [Unreleased]
### Fixed
- Allowing negative sales amount to be stored in the database.

### Changed
- All timestamp database columns converted to datetime.
- Several text based db columns widened to avoid future problems.

### Removed
- Removed many unused db columns.

## [0.1.0] – 2024-04-18

### Added
- Implemented sink API for stage 1: Raw retrieval (fetch).
- Implemented sink API for stage 2: DB import and removal.
- Implemented sink API for reverse chunk ID lookup.
- Implemented sink API for schemas and their descriptions.
