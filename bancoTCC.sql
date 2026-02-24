CREATE DATABASE YourDiet
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;
USE YourDiet;

-- tabela de usuario (login)

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,

  email VARCHAR(150) NOT NULL UNIQUE,
  senha VARCHAR(255) NOT NULL,

  nome VARCHAR(200) NOT NULL,
  data_nascimento DATE NOT NULL,

  peso_kg DECIMAL(5,2) NOT NULL,
  altura_cm DECIMAL(5,2) NOT NULL,

  sexo ENUM('Masculino','Feminino','Outro') NOT NULL,
  nivel_atividade ENUM(
    'Sedentario',
    'Leve',
    'Moderado',
    'Ativo',
    'Muito ativo'
  ) NOT NULL,
  
  meta ENUM(
	'Perder Peso',
    'Ganhar Peso',
    'Manter Peso'
  ) NOT NULL,

  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- tabela dos alimentos e dos seus valores nutricionais (fonte: ibge)

CREATE TABLE alimentos (
  id INT AUTO_INCREMENT PRIMARY KEY,

  Codigo INT,
  descricao_do_alimento VARCHAR(255),
  imagem varchar(200),
  Categoria VARCHAR(100),

  Codigo_de_preparacao INT,
  descricao_da_preparacao VARCHAR(100),

  Energia_kcal VARCHAR(20),
  Proteina_g VARCHAR(20),
  Lipidios_totais_g VARCHAR(20),
  Carboidrato_g VARCHAR(20),
  Fibra_alimentar_total_g VARCHAR(20), 
  Colesterol_mg VARCHAR(20),

  Ag_saturados_g VARCHAR(20),
  Ag_mono_g VARCHAR(20),
  Ag_poli_g VARCHAR(20),
  Ag_linoleico_g VARCHAR(20),
  Ag_linolenico_g VARCHAR(20),
  Ag_trans_total_g VARCHAR(20),

  Acucar_total_g VARCHAR(20),
  Acucar_de_adicao_g VARCHAR(20),

  Calcio_mg VARCHAR(20),
  Magnesio_mg VARCHAR(20),
  Manganes_mg VARCHAR(20),
  Fosforo_mg VARCHAR(20),
  Ferro_mg VARCHAR(20),
  Sodio_mg VARCHAR(20),
  Sodio_de_adicao_mg VARCHAR(20),
  Potassio_mg VARCHAR(20),

  Cobre_mg VARCHAR(20),
  Zinco_mg VARCHAR(20),
  Selenio_mcg VARCHAR(20),

  Retinol_mcg VARCHAR(20),
  Vitamina_A_RAE_mcg VARCHAR(20),

  Tiamina_mg VARCHAR(20),
  Riboflavina_mg VARCHAR(20),
  Niacina_mg VARCHAR(20),
  Niacina_ne_mg VARCHAR(20),
  Piridoxina_mg VARCHAR(20),
  Cobalamina_mcg VARCHAR(20),
  Folato_DFE_mcg VARCHAR(20),

  Vitamina_D_mcg VARCHAR(20),
  Vitamina_E_mg VARCHAR(20),
  Vitamina_C_mg VARCHAR(20)
);



SELECT COUNT(*) FROM alimentos;

-- Buscar alimentos pelo nome (simula busca no app)
SELECT id, descricao_do_alimento, energia_kcal
FROM alimentos
WHERE descricao_do_alimento LIKE '%arroz%'
LIMIT 10;

-- Listar categorias existentes (filtro do app)
SELECT DISTINCT categoria
FROM alimentos
ORDER BY categoria;

-- Ver um alimento completo (detalhe da tela)
SELECT *
FROM alimentos
LIMIT 1;





CREATE INDEX idx_nome_alimento ON alimentos(descricao_do_alimento);

-- tabela de registro do consumo diário de alimentos do usuário

CREATE TABLE consumo_diario (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT NOT NULL,
  alimento_id INT NOT NULL,
  data_consumo DATE NOT NULL,
  quantidade_gramas DECIMAL(6,2) NOT NULL,
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
  FOREIGN KEY (alimento_id) REFERENCES alimentos(id)
);

select * from alimentos;

INSERT INTO usuarios (
  email,
  senha,
  nome,
  data_nascimento,
  peso_kg,
  altura_cm,
  sexo,
  nivel_atividade,
  meta
) VALUES (
  'teste@yourdiet.com',
  '$2y$10$RzXc6z0V5F1m9Xz0Qx3JGe6Yc1H7ZQkXH3yYkQ9k3p8HqX9a',
  'Usuário Teste',
  '1998-06-15',
  78.50,
  175.00,
  'Masculino',
  'Moderado',
  'Manter Peso'
);


-- Copiando dados para tabela alimentos dados encontrados em sistema_tabela_nutricional.ibges: ~10.524 rows (aproximadamente)
INSERT INTO alimentos (Codigo, descricao_do_alimento, imagem, Categoria, Codigo_de_preparacao, descricao_da_preparacao, Energia_kcal, Proteina_g, Lipidios_totais_g, Carboidrato_g, Fibra_alimentar_total_g, Colesterol_mg, AG_saturados_g, AG_mono_g, AG_poli_g, AG_linoleico_g, AG_linolenico_g, AG_trans_total_g, Acucar_total_g, Acucar_de_adicao_g, Calcio_mg, Magnesio_mg, Manganes_mg, Fosforo_mg, Ferro_mg, Sodio_mg, Sodio_de_adicao_mg, Potassio_mg, Cobre_mg, Zinco_mg, Selenio_mcg, Retinol_mcg, Vitamina_A_RAE_mcg, Tiamina_mg, Riboflavina_mg, Niacina_mg, Niacina_NE_mg, Piridoxina_mg, Cobalamina_mcg, Folato_DFE_mcg, Vitamina_D_mcg, Vitamina_E_mg, Vitamina_C_mg) VALUES
	(6300101, 'Arroz','https://tse3.mm.bing.net/th/id/OIP.dt0gAzPe9CPeFdYi4N0l1QHaHa?rs=1&pid=ImgDetMain&o=7&rm=3', 'Cereais e leguminosas', NULL, 'Não se aplica', '135,62', '2,50', '1,20', '27,78', '1,55', '-', '0,35', '0,22', '0,56', '0,56', '0,07', '0,01', '-', '-', '3,51', '2,23', '0,29', '17,77', '0,08', '1,19', '382,00', '14,53', '0,01', '0,49', '0,45', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '0,08', '-'),
	(6300201, 'Arroz integral', 'https://tse1.mm.bing.net/th/id/OIP.dkazfPQXFF07Y58Aqz5agQHaHa?rs=1&pid=ImgDetMain&o=7&rm=3', 'Cereais e leguminosas', 99, 'Não se aplica', '130,95', '2,56', '1,97', '25,56', '2,72', '-', '0,45', '0,62', '0,86', '0,80', '0,08', '0,01', '-', '-', '5,15', '58,13', '0,62', '104,82', '0,26', '1,23', '282,00', '74,42', '0,02', '0,68', '0,45', '-', '-', '0,08', '-', '-', '-', '0,08', '-', '-', '-', '0,08', '-'),
	(6300701, 'Milho Cozido', 'https://shopee.com.br/blog/wp-content/uploads/2022/05/Milho-Cozido-420x420.png', 'Cereais e leguminosas', 2, 'Cozido(a)', '160,14', '3,32', '7,18', '25,11', '4,25', '-', '1,12', '1,72', '4,01', '3,59', '0,42', '0,03', '3,16', '-', '3,15', '26,01', '0,16', '75,00', '0,45', '244,96', '245,00', '212,05', '0,05', '0,61', '2,90', '-', '13,17', '0,22', '0,07', '1,61', '2,00', '0,06', '-', '46,00', '-', '0,57', '6,20'),
	(6301101, 'Ervilha em grão', 'https://tse4.mm.bing.net/th/id/OIP.SJUKnUDMS7j4qb135oHoBgHaG9?rs=1&pid=ImgDetMain&o=7&rm=3', 'Cereais e leguminosas', 99, 'Não se aplica', '109,09', '5,36', '3,06', '15,63', '5,50', '-', '0,48', '0,67', '1,74', '1,53', '0,21', '0,02', '5,94', '-', '27,00', '39,00', '0,53', '117,00', '1,54', '3,00', '236,00', '271,00', '0,17', '1,19', '3,20', '-', '40,08', '0,26', '0,15', '2,02', '2,64', '0,22', '-', '63,00', '-', '0,37', '14,20'),
	(6303102, 'Feijão preto', 'https://tse2.mm.bing.net/th/id/OIP.Wr2C9njYzwW8vEPwUWh1MQHaHa?rs=1&pid=ImgDetMain&o=7&rm=3', 'Cereais e leguminosas', 99, 'Não se aplica', '97,41', '5,84', '1,79', '15,05', '3,78', '-', '0,30', '0,38', '1,01', '0,86', '0,15', '0,01', '0,30', '-', '55,20', '38,20', '0,38', '67,80', '2,22', '5,20', '219,00', '336,60', '0,18', '0,83', '1,51', '-', '-', '0,07', '0,03', '0,08', '1,23', '0,06', '-', '48,60', '-', '0,69', '-'),
	(6400601, 'Mandioca Frita', 'https://tse1.mm.bing.net/th/id/OIP.RZsGu-fwRaU9AAaFfLQSdQAAAA?rs=1&pid=ImgDetMain&o=7&rm=3', 'Hortaliças tuberosas', 5, 'Frito(a)', '162,74', '0,57', '5,26', '28,60', '1,52', '-', '0,87', '1,23', '2,97', '2,58', '0,35', '0,03', '-', '-', '18,05', '25,65', '0,06', '20,90', '0,10', '0,95', '286,00', '95,00', '0,01', '0,19', '2,28', '-', '-', '0,06', '-', '-', '-', '0,03', '-', '-', '-', '0,41', '10,55'),
	(6401201, 'Cenoura', 'https://th.bing.com/th/id/R.d8ff20dc049639b6e9509715a953cbd7?rik=Uu%2bJMIMlkeoEtg&pid=ImgRaw&r=0', 'Hortaliças tuberosas', 1, 'Cru(a)', '41,00', '0,93', '0,24', '9,58', '2,80', '-', '0,04', '0,01', '0,12', '0,12', '-', '-', '4,73', '-', '33,00', '12,00', '0,14', '35,00', '0,30', '69,00', '-', '320,00', '0,05', '0,24', '0,10', '-', '840,50', '0,07', '0,06', '0,98', '1,18', '0,14', '-', '19,00', '-', '0,86', '5,90'),
	(6500401, 'Aveia em flocos', 'https://tse3.mm.bing.net/th/id/OIP.ZSiZxrrfP_3K_W22TFE1DwAAAA?rs=1&pid=ImgDetMain&o=7&rm=3', 'Farinhas, féculas e massas', 99, 'Não se aplica', '384,00', '16,00', '6,30', '67,00', '9,80', '-', '1,11', '1,98', '2,30', '2,20', '0,10', '-', '1,57', '-', '52,00', '148,00', '3,63', '474,00', '4,20', '4,00', '-', '350,00', '0,34', '3,07', '34,00', '-', '-', '0,73', '0,14', '0,78', '4,48', '0,12', '-', '32,00', '-', '0,70', '-'),
	(6700101, 'Alface', 'https://tse1.mm.bing.net/th/id/OIP.NFgJ5pCTUQASyR3hkV2POwHaHa?rs=1&pid=ImgDetMain&o=7&rm=3', 'Hortaliças folhosas, frutosas e outras', 99, 'Não se aplica', '15,00', '1,36', '0,15', '2,79', '1,30', '-', '0,02', '0,01', '0,08', '0,02', '0,06', '-', '0,79', '-', '36,00', '13,00', '0,25', '29,00', '0,86', '28,00', '-', '194,00', '0,03', '0,18', '0,60', '-', '370,25', '0,07', '0,08', '0,38', '0,53', '0,09', '-', '38,00', '-', '0,31', '18,00'),
	(6700501, 'Couve', 'https://tse2.mm.bing.net/th/id/OIP.mqfLZ_cE6B_LrsGQ5FXOUQHaHa?rs=1&pid=ImgDetMain&o=7&rm=3', 'Hortaliças folhosas, frutosas e outras', 1, 'Cru(a)', '30,00', '2,45', '0,42', '5,69', '3,60', '-', '0,06', '0,03', '0,20', '0,08', '0,11', '-', '1,63', '-', '145,00', '9,00', '0,28', '10,00', '0,19', '20,00', '-', '169,00', '0,04', '0,13', '1,30', '-', '333,42', '0,05', '0,13', '0,74', '1,26', '0,17', '-', '166,00', '-', '2,26', '35,30'),
	(6700901, 'Repolho', 'https://tse4.mm.bing.net/th/id/OIP.iodVGhL3y5hnsMP4paDc4QHaHa?rs=1&pid=ImgDetMain&o=7&rm=3', 'Hortaliças folhosas, frutosas e outras', 1, 'Cru(a)', '25,00', '1,28', '0,10', '5,80', '2,24', '-', '0,03', '0,02', '0,02', '0,02', '-', '-', '3,21', '-', '40,00', '12,00', '0,16', '26,00', '0,47', '18,00', '-', '170,00', '0,02', '0,18', '0,30', '-', '4,88', '0,06', '0,04', '0,23', '0,42', '0,12', '-', '43,00', '-', '0,15', '36,60'),
	(6701704, 'Brócolis Cozido', 'https://pngimg.com/uploads/broccoli/broccoli_PNG72914.png', 'Hortaliças folhosas, frutosas e outras', 2, 'Cozido(a)', '35,00', '2,38', '0,41', '7,18', '3,30', '-', '0,08', '0,04', '0,17', '0,05', '0,12', '-', '1,31', '-', '40,00', '21,00', '0,19', '67,00', '0,67', '41,00', '242,00', '293,00', '0,06', '0,45', '1,60', '-', '77,42', '0,06', '0,12', '0,55', '1,07', '0,20', '-', '108,00', '-', '2,02', '64,90'),
	(6801101, 'Banana', 'https://tse3.mm.bing.net/th/id/OIP.DzzBtp9wRuY1VocmOurZ7gHaJE?rs=1&pid=ImgDetMain&o=7&rm=3', 'Frutas', 1, 'Cru(a)', '89,00', '1,09', '0,33', '22,84', '2,60', '-', '0,11', '0,03', '0,07', '0,05', '0,03', '-', '12,23', '-', '5,00', '27,00', '0,27', '22,00', '0,26', '1,00', '-', '358,00', '0,08', '0,15', '1,00', '-', '3,21', '0,03', '0,07', '0,67', '0,82', '0,37', '-', '20,00', '-', '0,13', '8,70'),
	(6802202, 'Mexerica', 'https://tse1.mm.bing.net/th/id/OIP.Ls0HU4NiHkE1YZW3wzKJHAAAAA?rs=1&pid=ImgDetMain&o=7&rm=3', 'Frutas', 99, 'Não se aplica', '53,00', '0,81', '0,31', '13,34', '1,80', '-', '0,04', '0,06', '0,07', '0,05', '0,02', '-', '10,58', '-', '37,00', '12,00', '0,04', '20,00', '0,15', '2,00', '-', '166,00', '0,04', '0,07', '0,10', '-', '34,08', '0,06', '0,04', '0,38', '0,41', '0,08', '-', '16,00', '-', '0,20', '26,70'),
	(6802701, 'Abacate', 'https://tse1.mm.bing.net/th/id/OIP.SdqrMRMYNPDXhgImftgo_AHaHa?rs=1&pid=ImgDetMain&o=7&rm=3', 'Frutas', 99, 'Não se aplica', '120,00', '2,23', '10,06', '7,82', '5,60', '-', '1,96', '5,51', '1,68', '1,58', '0,10', '-', '2,42', '-', '10,00', '24,00', '0,10', '40,00', '0,17', '2,00', '-', '351,00', '0,31', '0,40', '0,40', '-', '7,04', '0,02', '0,05', '0,67', '1,14', '0,08', '-', '35,00', '-', '2,66', '17,40'),
	(6802601, 'Abacaxi', 'https://th.bing.com/th/id/OIP.jb3tZvJmuFa9RPx7QPXCCwHaHa?o=7rm=3&rs=1&pid=ImgDetMain&o=7&rm=3', 'Frutas', 99, 'Não se aplica', '48,00', '0,54', '0,12', '12,63', '1,40', '-', '0,01', '0,01', '0,04', '0,02', '0,02', '-', '9,26', '-', '13,00', '12,00', '1,18', '8,00', '0,28', '1,00', '-', '115,00', '0,10', '0,10', '0,10', '5,67', '2,83', '0,08', '0,03', '0,49', '0,57', '0,11', '-', '15,00', '-', '0,02', '36,20'),
	(6803001, 'Maçã', 'https://tse4.mm.bing.net/th/id/OIP.V9Xp2esTbiYx2cFz6Rk-LAHaHa?rs=1&pid=ImgDetMain&o=7&rm=3', 'Frutas', 99, 'Não se aplica', '52,00', '0,26', '0,17', '13,81', '2,40', '-', '0,03', '0,01', '0,05', '0,04', '0,01', '-', '10,40', '-', '6,00', '5,00', '0,04', '11,00', '0,12', '1,00', '-', '107,00', '0,03', '0,04', '-', '-', '2,71', '0,02', '0,03', '0,09', '0,11', '0,04', '-', '3,00', '-', '0,21', '4,60'),
	(6803101, 'Mamão', 'https://tse2.mm.bing.net/th/id/OIP.OxI_PD5erKrLZVhVPKpkNgHaHa?rs=1&pid=ImgDetMain&o=7&rm=3', 'Frutas', 99, 'Não se aplica', '39,00', '0,61', '0,14', '9,81', '1,80', '-', '0,04', '0,04', '0,03', '0,01', '0,03', '-', '4,86', '-', '24,00', '10,00', '0,01', '5,00', '0,10', '3,00', '-', '257,00', '0,02', '0,07', '0,60', '-', '54,71', '0,03', '0,03', '0,34', '0,47', '0,02', '-', '38,00', '-', '0,73', '61,80'),
	(6803201, 'Manga', 'https://png.pngtree.com/png-clipart/20250105/original/pngtree-mango-fruit-on-transparent-background-png-image_20020585.png', 'Frutas', 99, 'Não se aplica', '65,00', '0,51', '0,27', '17,00', '1,76', '-', '0,07', '0,10', '0,05', '0,01', '0,04', '-', '12,73', '-', '10,00', '9,00', '0,03', '11,00', '0,13', '2,00', '-', '156,00', '0,11', '0,04', '0,60', '-', '38,25', '0,06', '0,06', '0,58', '0,72', '0,13', '-', '14,00', '-', '1,12', '27,70'),
	(6803301, 'Maracujá', 'https://tse2.mm.bing.net/th/id/OIP.4lAan2VRDknDmBboPxUSAgHaHE?rs=1&pid=ImgDetMain&o=7&rm=3', 'Frutas', 99, 'Não se aplica', '97,00', '2,20', '0,70', '23,38', '10,40', '-', '0,06', '0,09', '0,41', '0,41', '-', '-', '10,40', '-', '12,00', '29,00', '0,20', '68,00', '1,60', '28,00', '-', '348,00', '0,09', '0,10', '0,60', '-', '63,63', '-', '0,13', '1,50', '1,50', '0,10', '-', '14,00', '-', '0,02', '30,00'),
	(6803401, 'Melancia', 'https://tse1.mm.bing.net/th/id/OIP.wJKstVqisplueDRnPx058wAAAA?rs=1&pid=ImgDetMain&o=7&rm=3', 'Frutas', 99, 'Não se aplica', '30,00', '0,61', '0,15', '7,55', '0,40', '-', '0,02', '0,04', '0,05', '0,05', '-', '-', '6,21', '-', '7,00', '10,00', '0,04', '11,00', '0,24', '1,00', '-', '112,00', '0,04', '0,10', '0,40', '-', '28,50', '0,03', '0,02', '0,18', '0,29', '0,05', '-', '3,00', '-', '0,05', '8,10'),
	(6803501, 'Melão', 'https://th.bing.com/th/id/R.77d5904b6f564e01e3ee163bc3c8681d?rik=irMsgD5BD5At7A&pid=ImgRaw&r=0', 'Frutas', 99, 'Não se aplica', '36,00', '0,54', '0,14', '9,09', '0,80', '-', '0,04', '-', '0,06', '0,03', '0,03', '-', '8,12', '-', '6,00', '10,00', '0,03', '11,00', '0,17', '18,00', '-', '228,00', '0,02', '0,09', '0,70', '-', '2,50', '0,04', '0,01', '0,42', '0,50', '0,09', '-', '19,00', '-', '0,03', '18,00'),
	(6803601, 'Pera', 'https://tse4.mm.bing.net/th/id/OIP.M2SZE57VhBXGXvyL0DCKMQHaHa?rs=1&pid=ImgDetMain&o=7&rm=3', 'Frutas', 99, 'Não se aplica', '58,00', '0,38', '0,12', '15,46', '3,16', '-', '0,01', '0,03', '0,03', '0,03', '-', '-', '9,79', '-', '9,00', '7,00', '0,05', '11,00', '0,17', '1,00', '-', '119,00', '0,08', '0,10', '0,10', '-', '1,17', '0,01', '0,03', '0,16', '0,19', '0,03', '-', '7,00', '-', '0,21', '4,20'),
	(6803701, 'Pêssego', 'https://tse1.explicit.bing.net/th/id/OIP.Gl62AHXqwx87e9rosL9fygHaHa?rs=1&pid=ImgDetMain&o=7&rm=3', 'Frutas', 99, 'Não se aplica', '39,00', '0,91', '0,25', '9,54', '1,50', '-', '0,02', '0,07', '0,09', '0,08', '-', '-', '8,38', '-', '6,00', '9,00', '0,06', '20,00', '0,25', '-', '-', '190,00', '0,07', '0,17', '0,10', '-', '16,29', '0,02', '0,03', '0,81', '0,97', '0,03', '-', '4,00', '-', '0,71', '6,60'),
	(6803901, 'Uva', 'https://tse4.mm.bing.net/th/id/OIP.Rj5K1yxcIYw9y6fuhO9EfwHaHY?rs=1&pid=ImgDetMain&o=7&rm=3', 'Frutas', 99, 'Não se aplica', '69,00', '0,72', '0,16', '18,10', '0,90', '-', '0,05', '0,01', '0,05', '0,04', '0,01', '-', '15,48', '-', '10,00', '7,00', '0,07', '20,00', '0,36', '2,00', '-', '191,00', '0,13', '0,07', '0,10', '-', '3,29', '0,07', '0,07', '0,19', '0,37', '0,09', '-', '2,00', '-', '0,38', '10,80'),
	(6803912, 'Uva passa', 'https://tse4.mm.bing.net/th/id/OIP.5jqTxLR8ZUL1VgjEmwuhewHaHa?rs=1&pid=ImgDetMain&o=7&rm=3', 'Frutas', 99, 'Não se aplica', '299,00', '3,07', '0,46', '79,18', '3,70', '-', '0,06', '0,05', '0,04', '0,03', '0,01', '-', '57,88', '-', '50,00', '32,00', '0,30', '101,00', '1,88', '11,00', '-', '749,00', '0,32', '0,22', '0,60', '-', '-', '0,11', '0,13', '0,77', '1,60', '0,17', '-', '5,00', '-', '0,11', '2,30'),
	(6804201, 'Goiaba', 'https://tse1.mm.bing.net/th/id/OIP.DivAUbWLH8GSDtrO6gDt1gHaHa?rs=1&pid=ImgDetMain&o=7&rm=3', 'Frutas', 99, 'Não se aplica', '68,00', '2,55', '0,95', '14,32', '5,40', '-', '0,27', '0,09', '0,40', '0,29', '0,11', '-', '8,82', '-', '18,00', '22,00', '0,15', '40,00', '0,26', '2,00', '-', '417,00', '0,23', '0,23', '0,60', '-', '31,17', '0,07', '0,04', '1,08', '1,45', '0,11', '-', '49,00', '-', '0,73', '228,30'),
	(6804301, 'Ameixa', 'https://png.pngtree.com/png-clipart/20220125/original/pngtree-a-plate-of-black-plum-fruits-png-image_7208256.png', 'Frutas', 99, 'Não se aplica', '46,00', '0,70', '0,28', '11,42', '1,40', '-', '0,02', '0,13', '0,04', '0,04', '-', '-', '9,93', '-', '6,00', '7,00', '0,05', '16,00', '0,17', '-', '-', '157,00', '0,06', '0,10', '-', '-', '17,29', '0,03', '0,03', '0,42', '0,57', '0,03', '-', '5,00', '-', '0,28', '9,50'),
	(6900501, 'Sorvete de qualquer sabor industrializado', 'https://tse4.mm.bing.net/th/id/OIP.ve9gJ2EybJJHxQFYqicGEwAAAA?rs=1&pid=ImgDetMain&o=7&rm=3', 'Açúcares e produtos de confeitaria', 99, 'Não se aplica', '206,00', '3,60', '11,00', '25,13', '0,87', '40,67', '6,79', '3,05', '0,44', '0,27', '0,17', '0,37', '18,89', '20,03', '121,67', '19,00', '0,05', '105,67', '0,37', '78,67', '-', '215,65', '0,06', '0,65', '2,03', '116,00', '117,58', '0,04', '0,23', '0,15', '0,93', '0,05', '0,36', '8,66', '0,62', '0,30', '0,63'),
	(6900502, 'Picolé de qualquer sabor industrializado', 'https://png.pngtree.com/png-vector/20240806/ourmid/pngtree-colorful-popsicle-ice-cream-treats-isolated-on-black-background-png-image_13392988.png', 'Açúcares e produtos de confeitaria', 99, 'Não se aplica', '79,00', '-', '0,24', '19,23', '-', '-', '0,01', '0,05', '0,02', '0,02', '-', '-', '13,67', '19,23', '-', '1,00', '-', '-', '0,54', '7,00', '-', '15,00', '-', '0,15', '0,20', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '0,70'),
	(7100101, 'Filé-mignon grelhado', 'https://www.eatme.com.br/cdn/shop/files/CB-FILEMINGONPNG_126843e3-7ffa-4830-a6f3-d9da383c0872.png?v=1736884373&width=1445', 'Carnes e vísceras', 3, 'Grelhado(a)/brasa/churrasco', '204,00', '30,67', '9,00', '-', '-', '58,00', '3,42', '3,92', '0,35', '0,24', '0,09', '0,41', '-', '-', '7,00', '20,00', '0,01', '193,00', '2,53', '41,00', '333,00', '252,00', '0,07', '5,20', '31,70', '-', '-', '0,07', '0,16', '5,36', '8,73', '0,40', '1,71', '10,00', '0,60', '0,43', '-'),
	(7100205, 'Bisteca bovina grelhada', 'https://tse3.mm.bing.net/th/id/OIP.69Mvmbzt2SbUl3GeHfmuuQHaHa?rs=1&pid=ImgDetMain&o=7&rm=3', 'Carnes e vísceras', 3, 'Grelhado(a)/brasa/churrasco', '471,00', '21,57', '41,98', '-', '-', '94,00', '17,80', '18,88', '1,53', '0,98', '0,50', '1,91', '-', '-', '12,00', '15,00', '0,01', '162,00', '2,31', '50,00', '333,00', '224,00', '0,10', '4,88', '20,80', '-', '-', '0,05', '0,15', '2,45', '4,82', '0,22', '2,62', '5,00', '0,60', '0,29', '-'),
	(7100301, 'Alcatra grelhada', 'https://tse1.mm.bing.net/th/id/OIP.nD6w1GbBMGT9ZcDrPNUalQHaHa?rs=1&pid=ImgDetMain&o=7&rm=3', 'Carnes e vísceras', 3, 'Grelhado(a)/brasa/churrasco', '204,00', '30,67', '9,00', '-', '-', '58,00', '3,42', '3,92', '0,35', '0,24', '0,09', '0,41', '-', '-', '7,00', '20,00', '0,01', '193,00', '2,53', '41,00', '333,00', '252,00', '0,07', '5,20', '31,70', '-', '-', '0,07', '0,16', '5,36', '8,73', '0,40', '1,71', '10,00', '0,60', '0,43', '-'),
	(7100304, 'Picanha', 'https://png.pngtree.com/png-vector/20230918/ourmid/pngtree-picanha-roasted-in-charcoal-barbecue-png-image_10093822.png', 'Carnes e vísceras', 3, 'Grelhado(a)/brasa/churrasco', '204,00', '30,67', '9,00', '-', '-', '58,00', '3,42', '3,92', '0,35', '0,24', '0,09', '0,41', '-', '-', '7,00', '20,00', '0,01', '193,00', '2,53', '41,00', '333,00', '252,00', '0,07', '5,20', '31,70', '-', '-', '0,07', '0,16', '5,36', '8,73', '0,40', '1,71', '10,00', '0,60', '0,43', '-'),
	(7803301, 'Ovo de galinha Frito', 'https://tse1.explicit.bing.net/th/id/OIP.WUdo7-8Ly5gSMlYVtQR56QHaHa?rs=1&pid=ImgDetMain&o=7&rm=3', 'Aves e ovos', 5, 'Frito(a)', '222,59', '13,67', '17,65', '1,22', '-', '460,87', '4,51', '5,83', '5,07', '4,41', '0,45', '0,03', '1,33', '-', '54,35', '10,87', '0,03', '186,96', '1,30', '134,78', '205,00', '136,96', '0,01', '1,14', '36,28', '182,61', '184,06', '0,07', '0,56', '0,07', '2,84', '0,13', '1,21', '47,83', '1,39', '1,62', '-');
    
    