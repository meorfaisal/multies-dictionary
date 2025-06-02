# Contributing to Wikikamus Scraper

Thank you for your interest in contributing to the Wikikamus Scraper project! This guide will help you get started.

## 🚀 Quick Start for Contributors

### Prerequisites

- PHP 7.4 or higher
- Git
- Basic understanding of PHP and regex patterns
- Familiarity with web scraping concepts

### Development Setup

1. **Fork the repository**
   ```bash
   # Click the 'Fork' button on GitHub, then clone your fork
   git clone https://github.com/YOUR_USERNAME/wikikamus-scraper.git
   cd wikikamus-scraper
   ```

2. **Set up development environment**
   ```bash
   # If using XAMPP
   cp -r . /xampp/htdocs/wikikamus-scraper/
   
   # Or use PHP built-in server for testing
   php -S localhost:8000
   ```

3. **Test the scraper**
   ```bash
   php wikikamus_scraper.php
   ```

## 🛠 Development Guidelines

### Code Style

- Use clear, descriptive variable names
- Add comments in both English and Malay for international collaboration
- Follow PSR-12 coding standards where applicable
- Use UTF-8 encoding throughout

### Testing Your Changes

1. **Syntax Check**
   ```bash
   php -l wikikamus_scraper.php
   ```

2. **Test with Limited Pages**
   ```php
   // Modify the range for testing
   $letters = ['A', 'B']; // Test with just A-B
   ```

3. **Verify Output**
   ```bash
   # Check word count
   wc -l ayat.txt
   
   # Sample first few words
   head -20 ayat.txt
   ```

## 📝 Making Contributions

### Types of Contributions Welcome

1. **Bug Fixes**
   - Fix regex patterns that miss words
   - Improve error handling
   - Resolve memory or performance issues

2. **Feature Enhancements**
   - Add progress tracking improvements
   - Implement new output formats
   - Add word categorization
   - Create web interface

3. **Documentation**
   - Improve README clarity
   - Add more code comments
   - Create usage examples
   - Translate documentation

4. **Testing**
   - Add unit tests
   - Test with different PHP versions
   - Validate against different platforms

### Contribution Process

1. **Create an Issue**
   - Describe the bug or feature request
   - Provide examples or use cases
   - Get feedback before starting work

2. **Make Your Changes**
   ```bash
   git checkout -b feature/your-feature-name
   # Make your changes
   git add .
   git commit -m "Add feature: your feature description"
   ```

3. **Test Thoroughly**
   - Run syntax checks
   - Test scraping functionality
   - Verify output quality

4. **Submit Pull Request**
   - Push to your fork
   - Create pull request to main repository
   - Provide clear description of changes

## 🐛 Bug Reports

When reporting bugs, please include:

- PHP version
- Operating system
- Error messages (if any)
- Steps to reproduce
- Expected vs actual behavior
- Sample of problematic output

### Bug Report Template

```markdown
**Bug Description**
Brief description of the issue

**Steps to Reproduce**
1. Run command...
2. Observe...

**Expected Behavior**
What should happen

**Actual Behavior**
What actually happened

**Environment**
- PHP Version: 
- OS: 
- Memory Available:

**Additional Context**
Any other relevant information
```

## 💡 Feature Requests

For new features, please consider:

- **Use Case**: Why is this feature needed?
- **Implementation**: How would you implement it?
- **Compatibility**: Will it break existing functionality?
- **Performance**: What's the impact on scraping speed/memory?

### Feature Request Template

```markdown
**Feature Description**
Clear description of the proposed feature

**Use Case**
Who would benefit and how?

**Proposed Implementation**
Technical approach or ideas

**Alternatives Considered**
Other ways to achieve the same goal

**Additional Context**
Screenshots, examples, or references
```

## 🔧 Common Development Tasks

### Adding New Extraction Patterns

```php
// Add new regex pattern
preg_match_all('/your-new-pattern/u', $html, $matches);

// Process matches
foreach ($matches[1] as $word) {
    if (!empty(trim($word))) {
        $words[] = trim($word);
    }
}
```

### Improving Word Cleaning

```php
// Add new cleaning rules
if (preg_match('/your-filter-pattern/', $word)) {
    continue; // Skip this word
}
```

### Adding Progress Tracking

```php
// Example progress enhancement
$total_pages = count($letters);
$current_page = array_search($letter, $letters) + 1;
$progress = ($current_page / $total_pages) * 100;
echo "Progress: " . round($progress, 1) . "% ($current_page/$total_pages)\n";
```

## 📚 Resources

- [PHP Official Documentation](https://www.php.net/docs.php)
- [Regular Expressions Guide](https://www.php.net/manual/en/book.pcre.php)
- [MediaWiki API Documentation](https://www.mediawiki.org/wiki/API:Main_page)
- [Wikikamus Project](https://ms.wiktionary.org/)

## 📞 Getting Help

- **GitHub Issues**: For bugs and feature requests
- **GitHub Discussions**: For questions and community chat
- **Email**: Contact project maintainers directly

## 🙏 Recognition

Contributors will be acknowledged in:
- README.md contributors section
- CHANGELOG.md for significant contributions
- GitHub contributors page

Thank you for helping improve the Wikikamus Scraper! 🚀
