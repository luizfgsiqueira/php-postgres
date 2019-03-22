-- Adminer 4.7.0 PostgreSQL dump

DROP TABLE IF EXISTS "user_tbl";
DROP SEQUENCE IF EXISTS user_tbl_id_seq;
CREATE SEQUENCE user_tbl_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."user_tbl" (
    "id" integer DEFAULT nextval('user_tbl_id_seq') NOT NULL,
    "username" character varying(15) NOT NULL,
    "password" text NOT NULL,
    "email" character varying(30) NOT NULL,
    "type" character varying(15) NOT NULL
) WITH (oids = false);

INSERT INTO "user_tbl" ("id", "username", "password", "email", "type") VALUES
(2,	'luiz',	'e10adc3949ba59abbe56e057f20f883e',	'luizfgsiqueira@gmail.com',	'user'),
(1,	'admin',	'e10adc3949ba59abbe56e057f20f883e',	'soengkanel@gmail.com',	'admin'),
(3,	'postgres',	'e8a48653851e28c69d0506508fb27fc5',	'postgres@gmail.com',	'user');

-- 2019-03-21 22:14:47.672794-04
