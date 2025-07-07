CREATE TABLE [dbo].[DailyActivity_Kategori](
	[kode_kategori] [varchar](50) NOT NULL,
	[nama_kategori] [varchar](200) NULL,
 CONSTRAINT [PK_DayActivity_Kategori] PRIMARY KEY CLUSTERED 
(
	[kode_kategori] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO