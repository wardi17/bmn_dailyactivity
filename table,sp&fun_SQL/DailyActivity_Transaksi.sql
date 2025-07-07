CREATE TABLE [dbo].[DailyActivity_Transaksi](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[tanggal] [datetime] NULL,
	[activity] [text] NULL,
	[category] [varchar](150) NULL,
	[noted] [text] NULL,
	[status] [varchar](100) NULL,
	[dateline] [datetime] NULL,
	[pic] [varchar](150) NULL,
	[tanggal_status] [datetime] NULL,
	[user_finish] [varchar](150) NULL,
 CONSTRAINT [PK_DailyActivity_Transaksi] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO
