CREATE TABLE "Customer" (
  "c_id" <type>,
  "c_firstName" <type>,
  "c_lastName" <type>,
  "c_email" <type>,
  "c_phone_no" <type>,
  "c_address" <type>,
  "c_regDate" <type>,
  PRIMARY KEY ("c_id")
);

CREATE INDEX "Key" ON  "Customer" ("c_firstName", "c_lastName", "c_email", "c_phone_no", "c_address", "c_regDate");

CREATE TABLE "Employee" (
  "E_id" <type>,
  "E_name" <type>,
  "E_email" <type>,
  "E_phone" <type>,
  "E_address" <type>,
  "E_hire_date" <type>,
  "E_position" <type>,
  "E_department" <type>,
  "E_salary" <type>,
  "E_status" <type>,
  PRIMARY KEY ("E_id")
);

CREATE INDEX "Key" ON  "Employee" ("E_name", "E_email", "E_phone", "E_address", "E_hire_date", "E_position", "E_department", "E_salary", "E_status");

CREATE TABLE "Job_site" (
  "js_id" <type>,
  "js_address" <type>,
  "c_id" <type>,
  "js_location" <type>,
  "js_zipcode" <type>,
  "js_siteType" <type>,
  "js_desc" <type>,
  "js_status" <type>,
  "E_id" <type>,
  "js_regDate" <type>,
  PRIMARY KEY ("js_id"),
  CONSTRAINT "FK_Job_site.c_id"
    FOREIGN KEY ("c_id")
      REFERENCES "Customer"("c_id"),
  CONSTRAINT "FK_Job_site.E_id"
    FOREIGN KEY ("E_id")
      REFERENCES "Employee"("E_id")
);

CREATE INDEX "Key" ON  "Job_site" ("js_address", "c_id", "js_location", "js_zipcode", "js_siteType", "js_desc", "js_status", "E_id", "js_regDate");

CREATE TABLE "Security_quard" (
  "sg_id" <type>,
  "sg_name" <type>,
  "sg_age" <type>,
  "sg_gender" <type>,
  "sg_phone" <type>,
  "sg_email" <type>,
  "sg_address" <type>,
  "sg_join_date" <type>,
  "sg_salary" <type>,
  "E_id" <type>,
  "sg_status" <type>,
  PRIMARY KEY ("sg_id"),
  CONSTRAINT "FK_Security_quard.E_id"
    FOREIGN KEY ("E_id")
      REFERENCES "Employee"("E_id")
);

CREATE INDEX "Key" ON  "Security_quard" ("sg_name", "sg_age", "sg_gender", "sg_phone", "sg_email", "sg_address", "sg_join_date", "sg_salary", "E_id", "sg_status");

CREATE TABLE "Payment" (
  "p_id" <type>,
  "c_id" <type>,
  "p_date" <type>,
  "js_id" <type>,
  "p_amount" <type>,
  "p_method" <type>,
  "p_status" <type>,
  "p_desc" <type>,
  PRIMARY KEY ("p_id"),
  CONSTRAINT "FK_Payment.js_id"
    FOREIGN KEY ("js_id")
      REFERENCES "Job_site"("js_id"),
  CONSTRAINT "FK_Payment.c_id"
    FOREIGN KEY ("c_id")
      REFERENCES "Customer"("c_id")
);

CREATE INDEX "Key" ON  "Payment" ("c_id", "p_date", "js_id", "p_amount", "p_method", "p_status", "p_desc");

CREATE TABLE "SecurityGuard_schedule" (
  "sgs_id" <type>,
  "sg_id" <type>,
  "js_id" <type>,
  "sgs_startTime" <type>,
  "sgs_endtime" <type>,
  "sgs_date" <type>,
  "sgs_notes" <type>,
  "sgs_desc" <type>,
  PRIMARY KEY ("sgs_id"),
  CONSTRAINT "FK_SecurityGuard_schedule.sg_id"
    FOREIGN KEY ("sg_id")
      REFERENCES "Security_quard"("sg_id")
);

CREATE INDEX "Key" ON  "SecurityGuard_schedule" ("sg_id", "js_id", "sgs_startTime", "sgs_endtime", "sgs_date", "sgs_notes", "sgs_desc");





CREATE TABLE "Customer" (
  "c_id" SERIAL PRIMARY KEY,
  "c_firstName" VARCHAR(50) NOT NULL,
  "c_lastName" VARCHAR(50) NOT NULL,
  "c_email" VARCHAR(100) NOT NULL UNIQUE,
  "c_phone_no" VARCHAR(20) NOT NULL,
  "c_address" TEXT NOT NULL,
  "c_regDate" DATE NOT NULL
);

CREATE INDEX "idx_Customer" ON "Customer" ("c_firstName", "c_lastName", "c_email", "c_phone_no", "c_address", "c_regDate");

CREATE TABLE "Employee" (
  "E_id" SERIAL PRIMARY KEY,
  "E_name" VARCHAR(100) NOT NULL,
  "E_email" VARCHAR(100) NOT NULL UNIQUE,
  "E_phone" VARCHAR(20) NOT NULL,
  "E_address" TEXT NOT NULL,
  "E_hire_date" DATE NOT NULL,
  "E_position" VARCHAR(50) NOT NULL,
  "E_department" VARCHAR(50) NOT NULL,
  "E_salary" NUMERIC(10, 2) NOT NULL,
  "E_status" VARCHAR(20) NOT NULL
);

CREATE INDEX "idx_Employee" ON "Employee" ("E_name", "E_email", "E_phone", "E_address", "E_hire_date", "E_position", "E_department", "E_salary", "E_status");

CREATE TABLE "Job_site" (
  "js_id" SERIAL PRIMARY KEY,
  "js_address" TEXT NOT NULL,
  "c_id" INT NOT NULL,
  "js_location" VARCHAR(50) NOT NULL,
  "js_zipcode" VARCHAR(20) NOT NULL,
  "js_siteType" VARCHAR(50) NOT NULL,
  "js_desc" TEXT NOT NULL,
  "js_status" VARCHAR(20) NOT NULL,
  "E_id" INT NOT NULL,
  "js_regDate" DATE NOT NULL,
  CONSTRAINT "FK_Job_site_c_id"
    FOREIGN KEY ("c_id")
      REFERENCES "Customer"("c_id"),
  CONSTRAINT "FK_Job_site_E_id"
    FOREIGN KEY ("E_id")
      REFERENCES "Employee"("E_id")
);

CREATE INDEX "idx_Job_site" ON "Job_site" ("js_address", "c_id", "js_location", "js_zipcode", "js_siteType", "js_desc", "js_status", "E_id", "js_regDate");

CREATE TABLE "Security_quard" (
  "sg_id" SERIAL PRIMARY KEY,
  "sg_name" VARCHAR(100) NOT NULL,
  "sg_age" INT NOT NULL,
  "sg_gender" VARCHAR(10) NOT NULL,
  "sg_phone" VARCHAR(20) NOT NULL,
  "sg_email" VARCHAR(100) NOT NULL UNIQUE,
  "sg_address" TEXT NOT NULL,
  "sg_join_date" DATE NOT NULL,
  "sg_salary" NUMERIC(10, 2) NOT NULL,
  "E_id" INT NOT NULL,
  "sg_status" VARCHAR(20) NOT NULL,
  CONSTRAINT "FK_Security_quard_E_id"
    FOREIGN KEY ("E_id")
      REFERENCES "Employee"("E_id")
);

CREATE INDEX "idx_Security_quard" ON "Security_quard" ("sg_name", "sg_age", "sg_gender", "sg_phone", "sg_email", "sg_address", "sg_join_date", "sg_salary", "E_id", "sg_status");

CREATE TABLE "Payment" (
  "p_id" SERIAL PRIMARY KEY,
  "c_id" INTEGER NOT NULL,
  "p_date" DATE NOT NULL,
  "js_id" INTEGER NOT NULL,
  "p_amount" NUMERIC(10, 2) NOT NULL,
  "p_method" VARCHAR(50) NOT NULL,
  "p_status" VARCHAR(50) NOT NULL,
  "p_desc" TEXT,
  CONSTRAINT "FK_Payment.js_id"
    FOREIGN KEY ("js_id")
      REFERENCES "Job_site"("js_id"),
  CONSTRAINT "FK_Payment.c_id"
    FOREIGN KEY ("c_id")
      REFERENCES "Customer"("c_id")
);

CREATE INDEX "idx_Payment" ON "Payment" ("c_id", "p_date", "js_id", "p_amount", "p_method", "p_status");

 CREATE TABLE "SecurityGuard_schedule" (
  "sgs_id" INTEGER PRIMARY KEY AUTOINCREMENT,
  "sg_id" INTEGER NOT NULL,
  "js_id" INTEGER NOT NULL,
  "sgs_startTime" DATETIME NOT NULL,
  "sgs_endtime" DATETIME NOT NULL,
  "sgs_date" DATE NOT NULL,
  "sgs_notes" TEXT NOT NULL,
  "sgs_desc" TEXT NOT NULL,
  PRIMARY KEY ("sgs_id"),
  CONSTRAINT "FK_SecurityGuard_schedule.sg_id"
    FOREIGN KEY ("sg_id")
      REFERENCES "Security_quard"("sg_id")
);

CREATE INDEX "Key" ON  "SecurityGuard_schedule" ("sg_id", "js_id", "sgs_startTime", "sgs_endtime", "sgs_date", "sgs_notes", "sgs_desc");
