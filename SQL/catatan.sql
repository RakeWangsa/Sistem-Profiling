USE [kepatuhan]
GO

/****** Object:  Table [dbo].[catatan]    Script Date: 15/06/2021 18:00:33 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[catatan](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[id_ppk] [bigint] NOT NULL,
	[perusahaan_id] [smallint] NOT NULL,
	[tanggal_pelanggaran] [date] NOT NULL,
	[tingkat_kepatuhan] [nvarchar](20) NOT NULL,
	[level_kepatuhan] [int] NOT NULL,
	[created_at] [datetime] NULL,
	[updated_at] [datetime] NULL,
	[pencatat] [nchar](20) NULL,
	[pencatat_id] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO


