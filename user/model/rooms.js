class Rooms {

    constructor(room_id, room_no, room_location, room_capacity, room_status, room_photo, created_at, updated_at ) {
        this.room_id = room_id;
        this.room_no = room_no;
        this.room_location = room_location;
        this.room_capacity = room_capacity;
        this.room_status = room_status;
        this.room_photo = room_photo;
        this.created_at = created_at;
        this.updated_at = updated_at;
    }
}

module.exports = Rooms;
