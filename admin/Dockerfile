FROM node:17.0.0-alpine
WORKDIR /usr/src/app/vueadmin
COPY package*.json ./
RUN npm install
COPY . .
EXPOSE 3000
CMD ["npx", "serve", "dist"]
