# OnlineHoster Website - Deployment Setup

## GitHub Auto-Sync Setup

This repository is set up with automatic deployment via GitHub webhooks.

### Webhook Configuration

1. **GitHub Repository Settings:**
   - Go to Settings → Webhooks → Add webhook
   - **Payload URL:** `https://onlinehoster.nl/webhook.php`
   - **Content type:** `application/json`
   - **Events:** Push events
   - **Active:** ✓ Checked

2. **Security - Enable Webhook Secret:**

   Generate a secure secret:
   ```bash
   openssl rand -base64 32
   ```

   Set it in GitHub webhook settings, then on the server:
   ```bash
   export GITHUB_WEBHOOK_SECRET="your_generated_secret"
   ```

   Or create `.env` file:
   ```bash
   cp .env.example .env
   # Edit .env and add your secret
   ```

3. **Rate Limiting:**
   - Maximum 10 webhook requests per minute per IP
   - Older entries are automatically cleaned up

### File Structure

- `.gitignore` - Excludes generated cache files (templates_c/)
- `webhook.php` - Webhook handler with security & rate limiting
- `/etc/logrotate.d/github-webhook` - Log rotation configuration
- `.env.example` - Environment variables template

### Monitoring

View webhook logs:
```bash
tail -f /var/log/github-webhook.log
```

### Cron Job

In addition to webhooks, there's also a fallback cron job (every minute):
```bash
crontab -l
```

## Deployment Flow

1. Push changes to GitHub `onlinehoofdsite` branch
2. GitHub sends webhook notification
3. `webhook.php` receives and validates request
4. `git pull` executes automatically
5. Changes are live immediately (or within 1 minute via cron fallback)

## Ignore Patterns

The following are automatically ignored in git:
- `templates_c/` - Generated template cache
- `.env` - Environment variables (local only)
- `*.log` - Log files
- `.DS_Store`, `Thumbs.db` - OS files
- `.vscode/`, `.idea/` - IDE files

---

**Last Updated:** December 21, 2025
**Deployed By:** GitHub Copilot
