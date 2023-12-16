# Symfony Test

Основано на [Symfony Docker](https://github.com/dunglas/symfony-docker)

1. f0e773d9d7bdd0531e5942e6470747d82c968634
Настройка докера и базы данных.
2. 3b5f35596db006e81c4cadb45d5ea078deeea8d4
Добавление сущности Car. Добавление миграции для нее, сервиса и роута для получения.
3. 06bd3e9d972130006dac1f8d3fb19630ffe3f36f
Добавление сущности Credit. Добавление миграции для нее, сервиса и роута для получения подходящего (по параметрам).
Также добавлен служебный роут для получения всех кредитов.
4. a137d4196f2dd512f4cc77287fcf8ae6fbc99e18
Добавление сущности CreditApplication. Добавление миграции для нее, сервиса и роута для добавления в базу.
Также добавлен служебный роут для получения всех заявок.
5. 744ad43bc09902c91872e8937c5a7d57e636ecf6
Добавление Fixtures для имитации данных в базе.

