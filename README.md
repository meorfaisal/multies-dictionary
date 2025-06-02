# Wikikamus Scraper - Malay Words Extractor

A PHP-based web scraper that extracts Malay words from Wikikamus (Malaysian Wiktionary) for use in language processing applications, specifically designed for the MULTIES project.

## 🎯 Purpose

This scraper extracts comprehensive Malay vocabulary from Wikikamus dictionary pages (A-Z) and saves them in a clean, organized format suitable for language learning applications, spell checkers, or linguistic analysis.

## ✨ Features

- **Complete A-Z Coverage**: Scrapes all alphabetical pages from Wikikamus
- **Smart Word Extraction**: Uses regex patterns to identify and extract Malay words from wiki markup
- **Data Cleaning**: Removes duplicates, filters invalid entries, and handles comma-separated words
- **Progress Tracking**: Shows real-time progress during scraping process
- **Memory Efficient**: Handles large datasets without memory issues
- **Rate Limiting**: Includes delays to respect server resources

## 🚀 Quick Start

### Prerequisites

- PHP 7.4 or higher
- Internet connection
- XAMPP (recommended) or any PHP server environment

### Installation

1. Clone this repository:
```bash
git clone https://github.com/yourusername/wikikamus-scraper.git
cd wikikamus-scraper
```

2. Or download the files directly to your web server directory

### Usage

1. Navigate to your project directory:
```bash
cd c:\xampp\htdocs\PORTFOLIO\MULTIES
```

2. Run the scraper:
```bash
php wikikamus_scraper.php
```

3. Wait for completion. The scraper will:
   - Process all pages A-Z from Wikikamus
   - Show progress for each page
   - Clean and filter the extracted words
   - Save results to `ayat.txt`

## 📁 File Structure

```
MULTIES/
├── wikikamus_scraper.php    # Main scraper script
├── ayat.txt                 # Output file with extracted words
├── index.php                # Web interface (if applicable)
├── README.md                # This documentation
└── LICENSE                  # License file
```

## 🔧 Configuration

The scraper includes several configurable parameters in the cleaning process:

```php
// Minimum word length (default: 2 characters)
if (mb_strlen($word, 'UTF-8') < 2) continue;

// Characters to exclude
if (preg_match('/[<>\[\](){}=+*#@$%^&|\\\\\/]/', $word)) continue;

// Sleep time between requests (default: 1 second)
sleep(1);
```

## 📊 Output Format

The scraper generates `ayat.txt` with:
- One word per line
- Alphabetically sorted
- UTF-8 encoding
- Duplicates removed
- Special characters cleaned

### Sample Output:
```
aba
abad
abadi
abah
abai
...
```

## 🛠 Technical Details

### How It Works

1. **URL Generation**: Constructs URLs for each alphabetical page (A-Z)
2. **HTML Fetching**: Downloads page content using `file_get_contents()`
3. **Pattern Matching**: Uses regex to extract words from:
   - Wiki links: `[[word]]` format
   - Markdown links: `[word](url)` format
   - Bullet points: `• [word]` format
4. **Data Cleaning**: Removes unwanted characters and duplicates
5. **Output**: Saves cleaned words to text file

### Regex Patterns Used

```php
// Wiki and markdown links
'/\[\[([^\]|]+)(?:\|[^\]]+)?\]\]|\[([^\]]+)\]\([^)]+\)/u'

// Bullet point links
'/• \[([^\]]+)\]/u'
```

## 📈 Performance

- **Speed**: ~1 second per page (26 seconds total for A-Z)
- **Memory**: Efficient handling of large word lists
- **Output**: Typically extracts **27,498+ unique Malay words**
- **Accuracy**: High precision with comprehensive cleaning

## 🔍 Actual Results

Latest scraping statistics (June 2025):
- Page A: 1,100 words
- Page B: 2,700 words (highest)
- Page S: 3,375 words  
- Page T: 2,800 words
- Page Q: 19 words (lowest)
- **Total**: **27,498 unique Malay words** across all A-Z pages

## 🤝 Contributing

Contributions are welcome! Please feel free to submit issues, feature requests, or pull requests.

### Development Setup

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## ⚠️ Disclaimer

This scraper is designed to respectfully extract publicly available content from Wikikamus. Please ensure compliance with:
- Wiktionary's terms of service
- Reasonable usage patterns
- Rate limiting guidelines

## 🔗 Related Projects

- **MULTIES**: Main language learning application
- **Wikikamus**: Source dictionary (https://ms.wiktionary.org/)

## 📞 Support

For questions, issues, or suggestions:
- Open an issue on GitHub
- Contact the maintainer

## 🏆 Acknowledgments

- Wikikamus contributors for maintaining the Malay dictionary
- MediaWiki for providing the platform
- PHP community for excellent regex support

---

*Last updated: June 2025*
