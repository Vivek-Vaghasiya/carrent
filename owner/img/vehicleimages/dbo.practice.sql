CREATE TABLE [dbo].[practice] (
    [Id]           INT NOT NULL IDENTITY,
    [name]         VARCHAR (50) NOT NULL,
    [address]      VARCHAR (50) NOT NULL,
    [email]        VARCHAR (50) NOT NULL ,
    [mobilenumber] VARCHAR(50)          NOT NULL,
    [phnumber]     VARCHAR(50)          NOT NULL,
    PRIMARY KEY CLUSTERED ([Id] ASC)
);

