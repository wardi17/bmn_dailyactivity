CREATE TABLE [dbo].[DailyActivity_Jabatan](
	[kode_jabatan] [varchar](25) NOT NULL,
	[nama_jabatan] [varchar](100) NULL,
	[level_jabatan] [int] NULL,
 CONSTRAINT [PK_DayActivity_Jabatan] PRIMARY KEY CLUSTERED 
(
	[kode_jabatan] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO