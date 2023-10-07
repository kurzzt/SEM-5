-- Membuat database 'responsi'
CREATE DATABASE IF NOT EXISTS responsi;
USE responsi;

-- Membuat tabel tb_provs
CREATE TABLE IF NOT EXISTS tb_provs (
    kode_prov VARCHAR(255) PRIMARY KEY,
    nama_prov VARCHAR(255)
);

-- Membuat tabel tb_kabs
CREATE TABLE IF NOT EXISTS tb_kabs (
    kode_kab VARCHAR(255) PRIMARY KEY,
    kode_prov VARCHAR(255),
    nama_kab VARCHAR(255),
    FOREIGN KEY (kode_prov) REFERENCES tb_provs(kode_prov)
);

-- Membuat tabel tb_user
CREATE TABLE IF NOT EXISTS tb_user (
    id INT(11) PRIMARY KEY,
    nama VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    jenis_kelamin VARCHAR(255),
    alamat TEXT,
    kode_prov VARCHAR(255),
    kode_kab VARCHAR(255),
    FOREIGN KEY (kode_prov) REFERENCES tb_provs(kode_prov),
    FOREIGN KEY (kode_kab) REFERENCES tb_kabs(kode_kab)
);

-- Memasukkan 10 record ke dalam tabel tb_provs dengan kode_prov diawali dengan teks
INSERT INTO tb_provs (kode_prov, nama_prov) VALUES
('Prov01', 'Provinsi A'),
('Prov02', 'Provinsi B'),
('Prov03', 'Provinsi C'),
('Prov04', 'Provinsi D'),
('Prov05', 'Provinsi E'),
('Prov06', 'Provinsi F'),
('Prov07', 'Provinsi G'),
('Prov08', 'Provinsi H'),
('Prov09', 'Provinsi I'),
('Prov10', 'Provinsi J');

-- Memasukkan 20 record ke dalam tabel tb_kabs dengan kode_kab diawali dengan teks
INSERT INTO tb_kabs (kode_kab, kode_prov, nama_kab) VALUES
('KabProv01', 'Prov01', 'Kabupaten AA'),
('KabProv02', 'Prov01', 'Kabupaten AB'),
('KabProv03', 'Prov02', 'Kabupaten BA'),
('KabProv04', 'Prov02', 'Kabupaten BB'),
('KabProv05', 'Prov03', 'Kabupaten CA'),
('KabProv06', 'Prov03', 'Kabupaten CB'),
('KabProv07', 'Prov04', 'Kabupaten DA'),
('KabProv08', 'Prov04', 'Kabupaten DB'),
('KabProv09', 'Prov05', 'Kabupaten EA'),
('KabProv10', 'Prov05', 'Kabupaten EB'),
('KabProv11', 'Prov06', 'Kabupaten FA'),
('KabProv12', 'Prov06', 'Kabupaten FB'),
('KabProv13', 'Prov07', 'Kabupaten GA'),
('KabProv14', 'Prov07', 'Kabupaten GB'),
('KabProv15', 'Prov08', 'Kabupaten HA'),
('KabProv16', 'Prov08', 'Kabupaten HB'),
('KabProv17', 'Prov09', 'Kabupaten IA'),
('KabProv18', 'Prov09', 'Kabupaten IB'),
('KabProv19', 'Prov10', 'Kabupaten JA'),
('KabProv20', 'Prov10', 'Kabupaten JB');

-- Memasukkan 10 record ke dalam tabel tb_user
INSERT INTO tb_user (id, nama, email, jenis_kelamin, alamat, kode_prov, kode_kab) VALUES
(1, 'User1', 'user1@example.com', 'Laki-Laki', 'Alamat 1', 'Prov01', 'KabProv01'),
(2, 'User2', 'user2@example.com', 'Perempuan', 'Alamat 2', 'Prov02', 'KabProv03'),
(3, 'User3', 'user3@example.com', 'Laki-Laki', 'Alamat 3', 'Prov03', 'KabProv05'),
(4, 'User4', 'user4@example.com', 'Perempuan', 'Alamat 4', 'Prov04', 'KabProv07'),
(5, 'User5', 'user5@example.com', 'Laki-Laki', 'Alamat 5', 'Prov05', 'KabProv09'),
(6, 'User6', 'user6@example.com', 'Perempuan', 'Alamat 6', 'Prov06', 'KabProv11'),
(7, 'User7', 'user7@example.com', 'Laki-Laki', 'Alamat 7', 'Prov07', 'KabProv13'),
(8, 'User8', 'user8@example.com', 'Perempuan', 'Alamat 8', 'Prov08', 'KabProv15'),
(9, 'User9', 'user9@example.com', 'Laki-Laki', 'Alamat 9', 'Prov09', 'KabProv17'),
(10, 'User10', 'user10@example.com', 'Perempuan', 'Alamat 10', 'Prov10', 'KabProv19');

-- Membuat trigger untuk mengatur kolom id pada tabel tb_user
DELIMITER //
CREATE TRIGGER tr_auto_increment_id
BEFORE INSERT ON tb_user
FOR EACH ROW
BEGIN
    DECLARE max_id INT;
    
    -- Menemukan nilai maksimum id saat ini dalam tabel
    SELECT MAX(id) INTO max_id FROM tb_user;
    
    -- Jika tidak ada data sebelumnya, set id ke 1
    IF max_id IS NULL THEN
        SET NEW.id = 1;
    ELSE
        -- Increment id sesuai dengan nilai maksimum yang ada
        SET NEW.id = max_id + 1;
    END IF;
END;
//
DELIMITER ;