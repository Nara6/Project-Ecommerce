FROM node:lts-alpine
WORKDIR /app
COPY . .
RUN npm install
EXPOSE 3000
CMD [ "npm", "run", "serve", "--", "--host", "0.0.0.0" ]