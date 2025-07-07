CREATE TABLE [dbo].[DailyActivity_user](
	[id_user] [int] IDENTITY(1,1) NOT NULL,
	[nama] [varchar](200) NULL,
	[email] [varchar](100) NULL,
	[cabang] [varchar](50) NULL,
	[password] [varchar](100) NULL,
	[divisi] [varchar](15) NULL,
	[jabatan] [varchar](15) NULL,
 CONSTRAINT [PK_DayActivity_user] PRIMARY KEY CLUSTERED 
(
	[id_user] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO