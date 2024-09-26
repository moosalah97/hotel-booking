# hotel-booking
A simple hotel booking system.

## API Endpoints

### Rooms
CRUD operations for managing hotel rooms.

- **GET /rooms** - Retrieve a list of all rooms.
- **GET /rooms/{id}** - Retrieve a specific room by its ID.
- **POST /rooms** - Create a new room.
  - Request body:
    ```json
    {
        "name": "Deluxe Room",
        "slug": "deluxe-room",
        "description": "A spacious room with a beautiful view and luxurious amenities.",
        "features": {
            "bed_type": "King Size",
            "room_size": "400 sq ft",
            "occupancy": 2,
            "view": "Sea View"
        },
        "published": true,
        "availability": 5,
        "images": [
            "image1.jpg",
            "image2.jpg"
        ]
    }
    ```
- **PUT /rooms/{id}** - Update an existing room by its ID.
  - Request body (example):
    ```json
    {
        "slug": "deluxe-room",
        "description": "A spacious room with a beautiful view and luxurious amenities.",
    }
    ```
- **DELETE /rooms/{id}** - Delete a room by its ID.

### Rateplans
CRUD operations for managing rate plans associated with rooms.

- **GET /rateplans** - Retrieve a list of all rate plans.
- **GET /rateplans/{id}** - Retrieve a specific rate plan by its ID.
- **POST /rateplans** - Create a new rate plan.
  - Request body:
    ```json
    {
        "room_id": 1,
        "name": "Standard Rate",
        "slug": "standard-rate",
        "detail": "Standard pricing for the room.",
        "price": 100.00
    }
    ```
- **PUT /rateplans/{id}** - Update an existing rate plan by its ID.
  - Request body (example):
    ```json
    {
        "detail": "Standard pricing for the room.",
    }
    ```
- **DELETE /rateplans/{id}** - Delete a rate plan by its ID.

### Calendars
CRUD operations for managing room availability.

- **GET /calendars** - Retrieve a list of all calendar entries (availability).
- **GET /calendars/{id}** - Retrieve specific calendar availability by its ID.
- **POST /calendars** - Create a new availability entry.
  - Request body:
    ```json
    {
        "room_id": 1,
        "rateplan_id": 1,
        "date": "2024-09-25",
        "price": 100.00
    }
    ```
- **PUT /calendars/{id}** - Update an existing availability entry by its ID.
  - Request body (example):
    ```json
    {
      "availability": 4,
    }
    ```
- **DELETE /calendars/{id}** - Delete a calendar availability entry by its ID.

### Bookings
CRUD operations for managing room bookings.

- **GET /bookings** - Retrieve a list of all bookings.
- **GET /bookings/{id}** - Retrieve a specific booking by its ID.
- **POST /bookings** - Create a new booking.
- **PUT /bookings/{id}** - Update an existing booking by its ID.
- **DELETE /bookings/{id}** - Delete a booking by its ID.

“**Tip**: You can test these booking operations using a simple UI interface that directly interacts with these API endpoints. This makes it easy to create, update, view, and delete bookings without needing to interact with raw API calls.”



#### Additional Booking Endpoints

- **POST /bookings/{id}/cancel** - Cancel a booking by its ID.
  - Example request:
    ```bash
    curl -X POST http://example.com/api/bookings/1/cancel
    ```

- **GET /revenue** - Retrieve the total revenue from all bookings.
  - Example response:
    ```json
    {
      "total_revenue_today"	"950.00"
      "total_revenue": 5000.0
    }
    ```
