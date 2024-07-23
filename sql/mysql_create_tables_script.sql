CREATE TABLE IF NOT EXISTS game_users (
	id        INT         PRIMARY KEY AUTO_INCREMENT,
	username  VARCHAR(63) NOT NULL UNIQUE,
	email     VARCHAR(63) NOT NULL UNIQUE,
	pass_word VARCHAR(63) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS mail (
	id          INT       PRIMARY KEY AUTO_INCREMENT,
	receiver_id INT       NOT NULL,
	sender_id   INT       NOT NULL,
	time_stamp  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	mail_text   TEXT      NOT NULL,
	
	FOREIGN KEY (receiver_id) REFERENCES game_users (id),
	FOREIGN KEY (sender_id) REFERENCES game_users (id)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS mates (
	user1_id INT NOT NULL,
	user2_id INT NOT NULL,
	
	PRIMARY KEY (user1_id, user2_id),
	FOREIGN KEY (user1_id) REFERENCES game_users(id),
    FOREIGN KEY (user2_id) REFERENCES game_users(id),
	CHECK (user1_id <> user2_id)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS mate_requests (
	requester_id INT NOT NULL,
	requested_id INT NOT NULL,
	
	PRIMARY KEY (requester_id, requested_id),
	FOREIGN KEY (requester_id) REFERENCES game_users(id),
    FOREIGN KEY (requested_id) REFERENCES game_users(id),
	CHECK (requester_id <> requested_id)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS football_players (
	id           INT         PRIMARY KEY AUTO_INCREMENT,
	player_name  VARCHAR(63) NOT NULL,
	rating       INT         NOT NULL DEFAULT 12,
	
	FOREIGN KEY (id) REFERENCES game_users (id)
) ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS generic_attributes (
	player_id       INT PRIMARY KEY AUTO_INCREMENT,
	strength        INT NOT NULL DEFAULT 2,
	movement        INT NOT NULL DEFAULT 2,
	skill           INT NOT NULL DEFAULT 4,
	attacking       INT NOT NULL DEFAULT 2,
	defending       INT NOT NULL DEFAULT 2,
	
	FOREIGN KEY (player_id) REFERENCES football_players (id)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS playing_attributes (
	player_id   INT PRIMARY KEY AUTO_INCREMENT,
	air_play    INT DEFAULT 1,
	duels       INT DEFAULT 1,
	agility     INT DEFAULT 1,
	pace        INT DEFAULT 1,
	dribbling   INT DEFAULT 1,
	passing     INT DEFAULT 1,
	shooting    INT DEFAULT 1,
	tackling    INT DEFAULT 1,
	opportunity INT DEFAULT 1,
	vision      INT DEFAULT 1,
	marking     INT DEFAULT 1,
	positioning INT DEFAULT 1,
	
	FOREIGN KEY (player_id) REFERENCES football_players (id)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS player_stats (
	player_id INT PRIMARY KEY AUTO_INCREMENT,
	games     INT NOT NULL DEFAULT 0,
	wins      INT NOT NULL DEFAULT 0,
	
	FOREIGN KEY (player_id) REFERENCES football_players (id)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS teams (
	id               INT         PRIMARY KEY AUTO_INCREMENT,
	team_name        VARCHAR(63) NOT NULL UNIQUE,
	team_class       VARCHAR(63) NOT NULL DEFAULT '5',
	members          INT         DEFAULT 1,
	rating           INT         NOT NULL,
	last_name_change TIMESTAMP   NOT NULL DEFAULT 0
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS team_player_invites (
	invite_id INT PRIMARY KEY AUTO_INCREMENT,
	team_id   INT NOT NULL,
	player_id INT NOT NULL,
	
	UNIQUE (team_id, player_id),
	FOREIGN KEY (team_id) REFERENCES teams (id),
	FOREIGN KEY (player_id) REFERENCES football_players (id)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS player_team (
	player_id  INT         PRIMARY KEY AUTO_INCREMENT,
	team_id    INT         DEFAULT NULL,
	staff_role VARCHAR(63) NOT NULL DEFAULT 'NONE',
	
	FOREIGN KEY (player_id) REFERENCES football_players (id),
	FOREIGN KEY (team_id) REFERENCES teams (id)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS player_team_applications (
	application_id INT PRIMARY KEY AUTO_INCREMENT,
	player_id      INT NOT NULL,
	team_id        INT NOT NULL,
	
	FOREIGN KEY (player_id) REFERENCES football_players (id),
	FOREIGN KEY (team_id) REFERENCES teams (id),
	UNIQUE (player_id, team_id)
) ENGINE = InnoDB;
