FROM node:22-alpine

WORKDIR /var/www/html

COPY ./src/package*.json ./

RUN npm install

COPY ./src .

RUN npm run build

EXPOSE 3000

CMD ["npm", "run", "dev"]