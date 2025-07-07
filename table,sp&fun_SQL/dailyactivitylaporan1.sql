USE [bmn]
GO
/****** Object:  StoredProcedure [dbo].[dailyactivitylaporan1]    Script Date: 09/07/2023 10:58:28 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[dailyactivitylaporan1] 
  @username varchar(100),
  @start_date datetime,
  @end_date  datetime


AS
BEGIN

IF EXISTS(SELECT [Table_name] FROM tempdb.information_schema.tables WHERE [Table_name] like '#temptess') 
    BEGIN
      DROP TABLE #temptess;
    END;


 create table #temptess
(
	id int,
	tanggal datetime,
	activity varchar(150),
	category varchar(100),
    noted varchar(200),
    status varchar(50),
    dateline varchar(50),
	pic varchar(100),
	divisi varchar(100),
	jabatan varchar(100)
);


  INSERT INTO #temptess
  SELECT t.id as id,t.tanggal as tanggal,t.activity as activity , t.category as category,
  t.noted as noted,t.status as status,t.dateline as dateline,t.pic as pic,u.divisi as divisi, j.level_jabatan as level
					FROM [bmn].[dbo].[DailyActivity_Transaksi] AS t
					INNER JOIN [bmn].[dbo].[DailyActivity_user] AS u ON t.pic = u.nama
					INNER JOIN [bmn].[dbo].[DailyActivity_Jabatan] AS j ON u.jabatan = j.kode_jabatan
					WHERE t.pic =@username AND tanggal BETWEEN @start_date AND @end_date
END;

SELECT * FROM #temptess

