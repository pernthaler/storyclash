FROM node:slim AS node
WORKDIR /app
COPY . .
RUN npm install
RUN npm run build

FROM nginx:alpine
COPY --from=node /app/dist /usr/share/nginx/html
COPY api /usr/share/nginx/html/api