# Storyclash Notes

Manage and track your Creators in projects and analyze them.

## Hosted

A hosted instance is available under: https://storyclash.pernthaler.dev

## Local

You can start a production environment locally with a single Docker command:

```bash
$ docker compose up --build
```

Now it is accessible under: http://localhost:8080

## Possible Enhancements

Before deploying to a real production system, proper authentication is needed, everything else is just a nice to have:

- Authentication (e.g. [GitHub](https://docs.github.com/en/apps/creating-github-apps/about-creating-github-apps/about-creating-github-apps))
- Permissions
- Emoji Reactions (e.g. GitHub / [GitLab](https://docs.gitlab.com/user/emoji_reactions/))
- Markdown Support
- Custom Animations
- Loading Skeleton
- Note Pagination
