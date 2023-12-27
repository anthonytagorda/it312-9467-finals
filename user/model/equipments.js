class Equipments {

    constructor(equip_id, equip_name, equip_no, equip_type, equip_photo, equip_status, created_at, updated_at ) {
        this.equip_id = equip_id;
        this.equip_name = equip_name;
        this.equip_no = equip_no;
        this.equip_type = equip_type;
        this.equip_photo = equip_photo;
        this.equip_status = equip_status;
        this.created_at = created_at;
        this.updated_at = updated_at;
    }
}

module.exports = Equipments;
