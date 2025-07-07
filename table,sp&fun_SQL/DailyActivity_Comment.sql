CREATE TABLE [dbo].[DailyActivity_Comment](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[tanggal] [date] NULL,
	[id_user] [int] NULL,
	[user_name] [varchar](50) NULL,
	[comment] [varchar](100) NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO