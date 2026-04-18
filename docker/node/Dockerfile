FROM node:20

# Instalar Angular CLI
RUN npm install -g @angular/cli

WORKDIR /app

EXPOSE 4200

CMD sh -c "npm install && ng serve --host 0.0.0.0"