#-----------------------------------#
#       FRONTEND DOCKER FILE        #
#-----------------------------------#

FROM node:18 AS builder

WORKDIR /app

RUN mkdir -p /app/dist && chmod -R 777 /app/dist

COPY package*.json ./

RUN npm install

COPY . .

# Construire l'application Vue.js
RUN npm run build

# Étape 2 : Servir l'application avec un serveur Node.js
EXPOSE 8080
CMD ["npm", "run", "serve"]