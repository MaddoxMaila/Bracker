CREATE TABLE buses(bus_id int not null PRIMARY KEY auto_increment, bus_number text not null, bus_plate text not null);

CREATE TABLE locations(bus_id int not null, latitude text not null, longitude text not null, street text not null, location_id int not null PRIMARY KEY auto_increment);

