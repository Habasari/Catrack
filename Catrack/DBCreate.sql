
CREATE TABLE elain (
id INT AUTO_INCREMENT,
nimi NVARCHAR(50) NOT NULL,
elain VARCHAR(50) NOT NULL,
kotipaikka VARCHAR(50) NOT NULL,
ika DATE NOT NULL,
sex int NOT NULL,

PRIMARY KEY (id)
);

CREATE TABLE tiedot (
id INT AUTO_INCREMENT NOT NULL,
elainid INT NOT NULL,
time DATETIME NOT NULL,
cordlang float NOT NULL,
cordlong float NOT NULL,
heartbeat int NOT NULL,
steps int NOT NULL,

PRIMARY KEY (id),
FOREIGN KEY (elainid) REFERENCES elain(id)
);