SET NAMES 'utf8' COLLATE 'utf8_general_ci';

UPDATE status SET DESCRIPTION = 'Запечатанная пластинка, которую не проигрывали' WHERE ID = 'M';
UPDATE status SET DESCRIPTION = 'Пластинка либо не проигрывалась, либо проигрывалась без слышимых дефектов' WHERE ID = 'NM';
UPDATE status SET DESCRIPTION = 'На диске видны следы износа от проигрывания, которые не влияют на звучание' WHERE ID = 'VG+';
UPDATE status SET DESCRIPTION = 'Слышен поверхностный шум во время проигрывания, легкие царапины' WHERE ID = 'VG';
UPDATE status SET DESCRIPTION = 'Значительный уровень шума, царапины, видимый износ дорожки' WHERE ID = 'G+';
UPDATE status SET DESCRIPTION = 'Погнутая пластинка, возможны перескоки звука, щелчки' WHERE ID = 'P';