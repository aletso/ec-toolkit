# EC3 Toolkit

A professional WordPress plugin for EC3 that provides Elementor widgets for displaying publication data.

## Description

EC3 Toolkit is a production-grade WordPress plugin developed by Aletso that extends Elementor with custom widgets designed specifically for academic publications and conference content management.

## Features

- **Publication Authors Widget**: Display publication authors with numbered institution references
- **Publication PDF Widget**: Embedded PDF viewer with download button
- **Typography Control**: Full control over styling through Elementor
- **ACF Integration**: Seamlessly integrates with Advanced Custom Fields
- **Responsive Design**: Mobile-friendly and print-optimized output
- **Production-Ready**: Built following WordPress and Elementor best practices

## Requirements

- WordPress 5.9 or higher
- PHP 7.4 or higher
- Elementor 3.0.0 or higher
- Advanced Custom Fields (ACF) plugin

## Installation

1. Upload the `ec3-toolkit` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Ensure Elementor and ACF are installed and activated
4. The widgets will appear in the Elementor editor under the "EC3 Toolkit" category

## Available Widgets

### Publication Authors

Displays publication authors with numbered references to their institutions.

**Features:**
- Automatic institution numbering
- Customizable typography for authors and institutions
- Adjustable spacing controls
- Support for multiple institutions per author
- Works with current post or custom post ID

**Usage:**
1. Add the "Publication Authors" widget to your Elementor page
2. Configure the source (current post or custom post ID)
3. Customize typography and spacing in the Style tab
4. Publish your page

**ACF Fields Required:**
- `author` (Relationship field) - Links to author posts
- `institution` (Taxonomy) - Author institutions

### Publication PDF

Displays publication PDF in an embedded viewer with optional download button.

**Features:**
- Embedded PDF viewer with iframe
- Customizable download button with full styling control
- Adjustable viewer height (responsive)
- Button hover states
- Works with current post or custom post ID

**Usage:**
1. Add the "Publication PDF" widget to your Elementor page
2. Configure the source (current post or custom post ID)
3. Toggle download button visibility and customize text
4. Adjust PDF viewer height and button styling
5. Publish your page

**ACF Fields Required:**
- `pdf` (File or URL field) - PDF file URL

## File Structure

```
ec3-toolkit/
├── ec3-toolkit.php           # Main plugin file
├── uninstall.php             # Cleanup on uninstall
├── includes/
│   ├── class-elementor-widgets.php
│   └── widgets/
│       ├── publication-authors.php
│       └── publication-pdf.php
└── languages/                # Translation files (future)
```

## Development

### Coding Standards

This plugin follows:
- WordPress Coding Standards
- Elementor development best practices
- PHP 7.4+ features
- Secure coding practices (input validation, output escaping, nonce verification)

### Security Features

- Input sanitization and validation
- Output escaping
- Nonce verification where applicable
- Capability checks
- Prevention of direct file access
- Singleton pattern for main class

## Changelog

### 1.1.0
- Added Publication PDF Elementor widget with embedded viewer
- Customizable download button with styling controls
- Responsive PDF viewer height control

### 1.0.0
- Initial release
- Publication Authors Elementor widget
- ACF integration
- Typography and styling controls

## Support

For support, please contact Aletso at https://aletso.com

## License

This plugin is licensed under the GPL v2 or later.

## Credits

**Author:** Aletso
**Website:** https://aletso.com

---

Made with care for EC3
