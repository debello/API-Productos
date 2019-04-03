
-- configura BD
CREATE TABLE IF NOT EXISTS `categorias` (
`id` int( 11 ) NOT NULL AUTO_INCREMENT ,
`nome` varchar( 255 ) NOT NULL ,
`descricion` text NOT NULL ,
`creada` datetime NOT NULL ,
`modificada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
PRIMARY KEY ( `id` )
) ENGINE = InnoDB DEFAULT CHARSET = utf8 AUTO_INCREMENT =20;

-- insertamos datos
INSERT INTO `categorias` (`id`, `nome`, `descricion`, `creada`, `modificada`) VALUES
(1, 'Moda', 'Categoria para todo o relacionado coa moda.', '2018-06-01 00:35:07', '2018-05-30 17:34:33'),
(2, 'Electronica', 'Gadgets, drones e mais.', '2018-06-01 00:35:07', '2018-05-30 17:34:33'),
(3, 'Motor', 'Deportes de motor e mais.', '2018-06-01 00:35:07', '2018-05-30 17:34:54'),
(5, 'Peliculas', 'Peliculas.', '0000-00-00 00:00:00', '2018-01-08 13:27:26'),
(6, 'Libros', 'Libros Kindle, audiolibros e mais.', '0000-00-00 00:00:00', '2018-01-08 13:27:47'),
(13, 'Deportes', 'Novas predas deportivas.', '2018-01-09 02:24:24', '2018-01-09 01:24:24');

-- creamos tabla Productos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `descricion` text NOT NULL,
  `prezo` decimal(10,0) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `creado` datetime NOT NULL,
  `modificado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65;

-- Insertamos datos na tabla Productos
INSERT INTO `produtos` (`id`, `nome`, `descricion`, `prezo`, `idCategoria`, `creado`, `modificado`) VALUES
(1, 'LG K40', 'O meu primeiro teléfono intelixente!', '336', 3, '2019-03-01 01:12:26', '2019-03-03 17:12:26'),
(2, 'Google Pixel 3', 'O mellor teléfono intelixente de 2019!', '299', 2, '2019-02-01 01:12:26', '2019-02-25 17:12:26'),
(3, 'Samsung Galaxy S4', 'Produto garantido', '600', 3, '2019-02-01 01:12:26', '2019-02-28 17:12:26'),
(6, 'Camiseta Desigual', 'A mellor camiseta!', '29', 1, '2019-02-01 01:12:26', '2019-02-28 02:12:21'),
(7, 'Portátil Lenovo', 'Para os negocios.', '399', 2, '2019-03-01 01:13:45', '2019-03-03 02:13:39'),
(8, 'Samsung Galaxy S10', 'Ultimas novidades en teléfonos intelixentes', '259', 2, '2019-02-01 01:14:13', '2019-02-25 02:14:08'),
(9, 'Reloxio Spalding', 'O reloxio dos deportistas.', '199', 1, '2019-02-01 01:18:36', '2019-02-25 02:18:31'),
(10, 'Reloxio Intelixente Smartwatch Sony', 'O mellor reloxio intelixente!', '300', 2, '2019-02-06 17:10:01', '2019-02-08 18:09:51'),
(11, 'Huawei Y300', 'Para probas.', '100', 2, '2019-02-06 17:11:04', '2019-02-09 18:10:54'),
(12, 'Camiseta Roberto Verino', 'O regalo perfeto!', '60', 1, '2019-02-06 17:12:21', '2019-02-09 18:12:11'),
(13, 'Camiseta bermella Adolfo Dominguez', 'Simpática camiseta bermella!', '70', 1, '2019-03-03 17:12:59', '2019-03-05 18:12:49'),
(26, 'Outro produto', 'Produto incrible!', '555', 2, '2019-02-22 19:07:34', '2019-03-03 20:07:34'),
(28, 'Carteira', 'Carteira de coiro', '799', 6, '2019-02-04 21:12:03', '2019-03-03 22:12:03'),
(31, 'Camiseta Xacobeo', 'Espectacular camiseta!', '333', 1, '2019-02-13 00:52:54', '2019-03-12 01:52:54'),
(42, 'Zapatos Nike para Home', 'Zapatos Nike', '12999', 3, '2019-02-12 06:47:08', '2019-03-12 05:47:08'),
(48, 'Zapatos Bristol', 'Os zapatos mais cómodos.', '999', 5, '2019-01-08 06:36:37', '2019-01-09 05:36:37'),
(60, 'Reloxio Rolex', 'Reloxio de luxo.', '25000', 1, '2019-01-11 15:46:02', '2019-01-18 14:46:02');
