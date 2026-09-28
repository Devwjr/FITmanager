FROM node:20-alpine AS build
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
ARG PUBLIC_API_URL
ENV PUBLIC_API_URL=$PUBLIC_API_URL
RUN npm run build
FROM node:20-alpine
WORKDIR /app
COPY --from=build /app/build ./build
COPY --from=build /app/package*.json ./
RUN npm ci --omit=dev
ENV HOST=0.0.0.0 PORT=10000 NODE_ENV=production
CMD ["node", "build"]
