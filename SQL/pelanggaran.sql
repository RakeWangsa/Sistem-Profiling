USE [kepatuhan]
GO

/****** Object:  Table [dbo].[pelanggaran]    Script Date: 15/06/2021 18:01:07 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[pelanggaran](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[checklist_id] [bigint] NOT NULL,
	[kriteria] [nchar](255) NOT NULL,
	[pelanggaran] [nvarchar](max) NOT NULL,
	[acuan] [nchar](255) NOT NULL,
	[keterangan] [nvarchar](max) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

ALTER TABLE [dbo].[pelanggaran]  WITH CHECK ADD  CONSTRAINT [pelanggaran_checklist_id_foreign] FOREIGN KEY([checklist_id])
REFERENCES [dbo].[checklist_pelanggaran] ([id])
GO

ALTER TABLE [dbo].[pelanggaran] CHECK CONSTRAINT [pelanggaran_checklist_id_foreign]
GO


