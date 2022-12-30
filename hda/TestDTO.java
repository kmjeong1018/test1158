/**
 * 공지사항 모델
 *
 * @author 진경수
 * @version 1.0, 생성
 */
package com.newriver.hondakorea_bo.model;

import lombok.*;
import org.springframework.stereotype.Component;

import javax.validation.constraints.NotNull;
import java.time.LocalDateTime;

@Component
@NoArgsConstructor
@AllArgsConstructor
@Builder
@Getter @Setter
@ToString
public class TestDTO {
    private long ntcSeq; // 시퀀스
    @NotNull
    private String title; // 제목
    private String contents; // 내용
    private int readCnt; // 조회수
    private String viewYn; // 노출여부
    // 공통
    private String useYn;
    private String createdBy;
    private LocalDateTime createdAt;
    private String createdIp;
    private String updatedBy;
    private LocalDateTime updatedAt;
    private String updatedIp;

    // 날짜
    private String creDate;
    private String updDate;
 }
