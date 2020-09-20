-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE pessoa (
  id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nome varchar'(50)' COLLATE utf8_unicode_ci NOT NULL,
  telefone varchar'(35)' COLLATE utf8_unicode_ci NOT NULL,
  email varchar'(80)' COLLATE utf8_unicode_ci NOT NULL,
  cidade varchar'(50)' COLLATE utf8_unicode_ci NOT NULL,
  estado varchar'(5)' COLLATE utf8_unicode_ci NOT NULL,
  categoria varchar '(11)' COLLATE utf8_unicode_ci NOT NULL,
  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
)

