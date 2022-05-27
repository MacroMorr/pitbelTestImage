FROM node:lts-alpine

# устанавливаем простой HTTP-сервер для статики
RUN npm install -g http-server

# делаем каталог 'app' текущим рабочим каталогом
WORKDIR /

# монтируем файлы и каталоги проекта в текущий рабочий каталог (т.е. в каталог 'app')
VOLUME . .

# устанавливаем зависимости проекта
RUN npm install

# собираем приложение для production с минификацией
RUN npm run build

EXPOSE 8080
CMD [ "http-server", "dist" ]
