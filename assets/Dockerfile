ARG NODE_VERSION=14

# "common" stage
FROM node:${NODE_VERSION}-alpine AS eoffice_pwa_common

EXPOSE 3000

WORKDIR /usr/src/pwa

ENV NEXT_TELEMETRY_DISABLED 1

# prevent the reinstallation of node modules at every changes in the source code
COPY package.json yarn.lock ./
RUN yarn

COPY ./ ./

VOLUME /usr/src/pwa/node_modules


# "development" stage
# depends on the "common" stage above
FROM eoffice_pwa_common AS eoffice_pwa_dev

ENV EOFFICE_CLIENT_GENERATOR_OUTPUT .
RUN yarn global add @api-platform/client-generator

CMD ["yarn", "watch"]


# "build" stage
# depends on the "common" stage above
FROM eoffice_pwa_common AS eoffice_pwa_prod

ENV NODE_ENV production
ARG NEXT_PUBLIC_ENTRYPOINT

RUN set -eux; \
	yarn build

CMD ["yarn", "start"]
