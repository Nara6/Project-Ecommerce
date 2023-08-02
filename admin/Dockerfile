FROM node:lts-alpine
WORKDIR /app
COPY . .
RUN npm install
EXPOSE 5174
CMD [ "npm", "run", "serve", "--", "--host", "0.0.0.0" ]