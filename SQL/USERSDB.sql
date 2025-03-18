SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

USE [master]

IF EXISTS (SELECT * FROM sys.databases WHERE name = 'UsersDB')
	ALTER DATABASE UsersDB SET SINGLE_USER WITH ROLLBACK IMMEDIATE;
	DROP DATABASE UsersDB;
GO

CREATE DATABASE UsersDb;
GO

USE UsersDB;
GO

IF EXISTS (SELECT * FROM sys.objects 
		WHERE object_id = OBJECT_ID(N'[dbo].[Usuario]') 
		AND type in (N'U'))
BEGIN
DROP TABLE Usuario;
END
GO

IF NOT EXISTS (SELECT * FROM sys.objects 
		WHERE object_id = OBJECT_ID(N'[dbo].[Usuario]') 
		AND type in (N'U'))
BEGIN
	CREATE TABLE [dbo].[Usuario](
		Usuario  [nvarchar](20) NOT NULL,
		Passwd   [nvarchar](30) NOT NULL,
		Email    [nvarchar](40) NOT NULL,
		Nombre   [nvarchar](20) NOT NULL,
		Apellido [nvarchar](20) NOT NULL,


		CONSTRAINT [PK_User] PRIMARY KEY CLUSTERED
		(
			[Usuario] ASC
		)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
	)ON [PRIMARY]
END
GO

SELECT * FROM Usuario;