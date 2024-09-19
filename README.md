## Endpointy API

### Książki

#### 1. Listowanie książek
- **Endpoint**: `GET /api/books`
- **Opis**: Zwraca listę książek (paginowane po 20 na stronę).

#### 2. Szczegóły książki
- **Endpoint**: `GET /api/books/{id}`
- **Opis**: Zwraca szczegóły książki na podstawie jej ID.

#### 3. Wyszukiwanie książek
- **Endpoint**: `GET /api/books/search`
- **Opis**: Wyszukiwanie książek na podstawie nazwy, autora lub osoby, która wypożyczyła książkę.
- **Parametry zapytania**:
    - `name`: Nazwa książki
    - `author`: Autor książki
    - `rented_by`: Imię i nazwisko klienta

### Klienci

#### 1. Listowanie klientów
- **Endpoint**: `GET /api/clients`
- **Opis**: Zwraca listę wszystkich klientów.

#### 2. Szczegóły klienta
- **Endpoint**: `GET /api/clients/{id}`
- **Opis**: Zwraca szczegóły klienta, w tym listę wypożyczonych książek.

#### 3. Tworzenie klienta
- **Endpoint**: `POST /api/clients`
- **Opis**: Tworzy nowego klienta.
- **Parametry**:
    - `name`: Nazwa klienta (string, wymagane)

#### 4. Usuwanie klienta
- **Endpoint**: `DELETE /api/clients/{id}`
- **Opis**: Usuwa klienta, o ile nie ma aktywnych wypożyczeń.

### Wypożyczenia

#### 1. Wypożyczenie książki
- **Endpoint**: `POST /api/rentals/rent`
- **Opis**: Wypożyczenie książki przez klienta.
- **Parametry**:
    - `book_id`: ID książki (wymagane)
    - `client_id`: ID klienta (wymagane)

#### 2. Zwrot książki
- **Endpoint**: `PUT /api/rentals/return/{id}`
- **Opis**: Zwrot książki przez klienta.
