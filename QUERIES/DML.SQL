-- SAMPLE DATA FOR book
INSERT INTO book (CODE, TITLE, DSCP, STOCK, IS_DEL, DT_CREATE, CREATE_BY, DT_UPDATE, UPDATE_BY, PRICE) VALUES ("ABC123", "noob shit book", "it is a book for a noob shit", 12, "N", NOW(), "hans", NOW(), "hans", 300);

-- SAMPLE DATA FOR user
INSERT INTO user (USERNAME, PASSWORD, EMAIL, USER_TYPE, DT_CREATE, CREATE_BY, DT_UPDATE, UPDATE_BY, IS_DEL) VALUES ("hans", "1234", "hansbrians@gmail.com", "admin", NOW(), "admin", NOW(), "admin", "N");

-- SAMPLE DATA FOR transaction
INSERT INTO transaction (USERNAME, BOOK_CODE, QUANTITY, STATUS, DT_CREATE, RANDOM_ID) VALUES ("hans", "ABC123", 5, "PAID", NOW(), "KRMN87991");