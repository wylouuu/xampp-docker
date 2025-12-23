FROM node:20-alpine

WORKDIR /app

# Install BrowserSync globally
RUN npm install -g browser-sync

# Expose BrowserSync UI and proxy ports
EXPOSE 3000 3001

CMD ["browser-sync", "start", "--proxy", "web:80", "--files", "/www/**/*.php,/www/**/*.html,/www/**/*.css,/www/**/*.js", "--no-open", "--no-notify"]

