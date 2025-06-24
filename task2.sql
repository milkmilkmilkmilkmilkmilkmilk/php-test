CREATE TABLE `info` (
        `id` int(11) NOT NULL auto_increment,
       `name` varchar(255) default NULL,
        `desc` text default NULL,
        PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

CREATE TABLE `data` (
        `id` int(11) NOT NULL auto_increment,
        `date` date default NULL,
        `value` INT(11) default NULL,
        PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

CREATE TABLE `link` (
        `data_id` int(11) NOT NULL,
        `info_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- Предложение оптимизации

CREATE TABLE info (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) DEFAULT NULL,
    desc TEXT DEFAULT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

CREATE TABLE data (
    id INT(11) NOT NULL AUTO_INCREMENT,
    date DATE DEFAULT NULL,
    value INT(11) DEFAULT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

CREATE TABLE link (
    data_id INT(11) NOT NULL,
    info_id INT(11) NOT NULL,
    PRIMARY KEY (data_id, info_id),  -- Добавление первичного ключа для уникальности
    FOREIGN KEY (data_id) REFERENCES data(id) ON DELETE CASCADE,  -- Внешний ключ для связи с таблицей data
    FOREIGN KEY (info_id) REFERENCES info(id) ON DELETE CASCADE   -- Внешний ключ для связи с таблицей info
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

-- Добавление индексов для оптимизации запросов
ALTER TABLE link ADD INDEX idx_data_id (data_id);
ALTER TABLE link ADD INDEX idx_info_id (info_id);