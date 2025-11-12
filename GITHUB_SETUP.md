# GitHub Auto-Update Setup Guide

This guide explains how to set up automatic WordPress plugin updates from GitHub.

## Method 1: GitHub Updater Plugin (Recommended - Easy)

### Step 1: Install GitHub Updater on WordPress

**Option A: Download from GitHub**
1. Download the latest release: https://github.com/afragen/github-updater/releases
2. Upload to WordPress via Plugins > Add New > Upload Plugin
3. Activate the plugin

**Option B: Install via WP-CLI**
```bash
wp plugin install github-updater --activate
```

### Step 2: Create GitHub Repository

1. Create a new repository on GitHub:
   - Repository name: `ec3-toolkit`
   - Visibility: Private or Public (your choice)
   - Don't initialize with README (we already have one)

2. Push your plugin to GitHub:
```bash
cd /Users/gijsbartman/Documents/Aletso/EC3-ui
git init
git add .
git commit -m "Initial commit: EC3 Toolkit v1.0.0"
git branch -M main
git remote add origin https://github.com/aletso/ec3-toolkit.git
git push -u origin main
```

### Step 3: Create GitHub Personal Access Token (for private repos)

1. Go to GitHub Settings > Developer settings > Personal access tokens > Tokens (classic)
2. Click "Generate new token (classic)"
3. Name it: "WordPress GitHub Updater"
4. Select scopes: `repo` (Full control of private repositories)
5. Click "Generate token"
6. Copy the token (you won't see it again!)

### Step 4: Configure WordPress

1. Go to WordPress Dashboard > Settings > GitHub Updater > Settings
2. Click "Install Plugin" tab
3. Paste your plugin's GitHub URL: `https://github.com/aletso/ec3-toolkit`
4. If private repo: Add your GitHub Personal Access Token
5. Click "Install Plugin"

### Step 5: Create a Release (Required)

For each version update:

1. Update version in `ec3-toolkit.php`:
   - Change `Version: 1.0.0` to new version (e.g., `1.0.1`)
   - Update `EC3_TOOLKIT_VERSION` constant

2. Commit and push changes:
```bash
git add .
git commit -m "Version 1.0.1: Description of changes"
git push origin main
```

3. Create a GitHub Release:
   - Go to your repo on GitHub
   - Click "Releases" > "Create a new release"
   - Tag version: `1.0.1`
   - Release title: `v1.0.1`
   - Description: What changed
   - Click "Publish release"

4. WordPress will now detect the update!

### How It Works

- GitHub Updater checks your repository for new releases
- When you create a new release on GitHub, WordPress detects it
- Users see an "Update available" notice in WordPress
- They can update with one click

## Method 2: Custom Update Server (Advanced)

If you want more control, you can build a custom update server, but this requires:
- A server to host update metadata JSON
- More complex setup
- Not recommended unless you need advanced features

## Quick Update Workflow

Once set up, your workflow is:

1. Make code changes locally
2. Update version number in `ec3-toolkit.php`
3. Commit and push to GitHub:
```bash
git add .
git commit -m "Version 1.0.x: Your changes"
git push origin main
```

4. Create GitHub Release with the new version tag
5. WordPress automatically detects the update
6. Click "Update" in WordPress Dashboard

## Troubleshooting

**Updates not showing?**
- Verify GitHub headers in `ec3-toolkit.php` are correct
- Check GitHub repository URL is accessible
- Ensure you created a GitHub Release (not just pushed code)
- Clear WordPress transients: Settings > GitHub Updater > Refresh Cache

**Private repository not working?**
- Verify Personal Access Token is valid
- Check token has `repo` scope
- Re-enter token in WordPress settings

## Alternative: Deploy Plugin to WordPress.org

For public distribution:
1. Submit to WordPress.org plugin directory
2. Updates happen automatically through WordPress.org
3. No GitHub Updater needed
4. More visibility and trust from users

## Notes

- GitHub Updater works with private and public repos
- Free for unlimited plugins/themes
- Version tags in GitHub releases are required
- Semantic versioning recommended (1.0.0, 1.0.1, 1.1.0, etc.)
