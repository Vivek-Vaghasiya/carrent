CREATE TABLE [dbo].[practice]
(
	[Id] INT NOT NULL, 
    [name] VARCHAR(50) NOT NULL, 
    [address] VARCHAR(50) NOT NULL, 
    [email] VARCHAR(50) NOT NULL, 
    [mobilenumber] INT NOT NULL, 
    [phnumber] INT NOT NULL, 
    CONSTRAINT [PK_Table] PRIMARY KEY ([Id]) 
)
