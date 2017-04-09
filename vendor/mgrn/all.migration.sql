CREATE TABLE person (

person_id integer PRIMARY KEY,
login text NOT NULL UNIQUE,
msg_login text NOT NULL,
tech_login text NOT NULL UNIQUE,
pass text NOT NULL
);

CREATE TABLE sms_private (

sms_id bigint PRIMARY KEY,
msg text NOT NULL DEFAULT '',
person_id integer NOT NULL REFERENCES person (person_id),
person_to_id integer NOT NULL REFERENCES person (person_id),
create_time timestamp DEFAULT current_timestamp,
hidden boolean DEFAULT false,
CONSTRAINT real_msg CHECK (person_id != person_to_id)
);

CREATE TABLE dialog (

dialog_id integer PRIMARY KEY,
name text NOT NULL,
person_id integer NOT NULL REFERENCES person (person_id),
tech_login text NOT NULL UNIQUE,
deleted boolean NOT NULL DEFAULT false
);

CREATE TABLE dialog_to_member (

dialog_id integer NOT NULL REFERENCES dialog (dialog_id),
person_id integer NOT NULL REFERENCES person (person_id)
);

CREATE TABLE sms_dialog (

sms_id bigint PRIMARY KEY,
msg text NOT NULL DEFAULT '',
person_id integer NOT NULL REFERENCES person (person_id),
dialog_id integer NOT NULL REFERENCES dialog (dialog_id),
create_time timestamp DEFAULT current_timestamp,
hidden boolean DEFAULT false
);