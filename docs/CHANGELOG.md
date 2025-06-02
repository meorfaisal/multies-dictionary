# Changelog

All notable changes to the Wikikamus Scraper project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2025-06-02

### Added
- Initial release of Wikikamus Scraper
- Complete A-Z word extraction from Wikikamus (Malaysian Wiktionary)
- Smart regex-based word extraction for multiple formats:
  - Wiki links: `[[word]]` format
  - Markdown links: `[word](url)` format  
  - Bullet points: `• [word]` format
- Comprehensive data cleaning pipeline:
  - UTF-8 support for Malay characters
  - Minimum word length filtering (2+ characters)
  - Special character removal
  - Comma-separated word handling
  - Duplicate removal
- Progress tracking during scraping process
- Rate limiting (1 second delay between requests)
- Memory efficient processing for large datasets
- Output to `ayat.txt` with one word per line

### Features
- Extracts 27,000+ unique Malay words
- Processes all 26 alphabetical pages (A-Z)
- Clean, organized output suitable for language applications
- Respects server resources with appropriate delays
- Comprehensive error handling

### Technical
- PHP 7.4+ compatibility
- Cross-platform support (Windows, Linux, macOS)
- Minimal dependencies (built-in PHP functions only)
- Efficient memory usage
- UTF-8 encoding throughout

### Documentation
- Complete README.md with installation and usage instructions
- MIT license for open source distribution
- GitHub workflow for automated syntax checking
- Comprehensive code comments in Malay and English

## [Planned] - Future Releases

### [1.1.0] - Planned
- [ ] Enhanced progress tracking with percentage completion
- [ ] Configurable output formats (JSON, CSV, XML)
- [ ] Word categorization by part of speech
- [ ] Comprehensive logging system
- [ ] Resume functionality for interrupted scraping

### [1.2.0] - Planned
- [ ] Web interface for non-technical users
- [ ] Scheduled automatic updates
- [ ] Word frequency analysis
- [ ] Export to popular dictionary formats
- [ ] Integration with language learning platforms
