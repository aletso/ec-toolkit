# EC3 Toolkit

A professional WordPress plugin for EC3 that provides Elementor widgets for displaying publication data.

## Description

EC3 Toolkit is a production-grade WordPress plugin developed by Aletso that extends Elementor with custom widgets designed specifically for academic publications and conference content management.

## Features

- **Publication Authors Widget**: Display publication authors with numbered institution references
- **Typography Control**: Full control over author and institution typography through Elementor
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

## File Structure

```
ec3-toolkit/
├── ec3-toolkit.php           # Main plugin file
├── uninstall.php             # Cleanup on uninstall
├── includes/
│   ├── class-elementor-widgets.php
│   └── widgets/
│       └── publication-authors.php
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

### 1.0.0
- Initial release
- Publication Authors Elementor widget
- ACF integration
- Typography controls

## Support

For support, please contact Aletso at https://aletso.com

## License

This plugin is licensed under the GPL v2 or later.

## Credits

**Author:** Aletso
**Website:** https://aletso.com

---

Made with care for EC3
