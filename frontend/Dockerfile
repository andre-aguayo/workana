FROM node:16 as frontend
WORKDIR /app

COPY ./package.json ./
RUN yarn install

COPY . .

EXPOSE 3000

CMD ["yarn", "serve"]