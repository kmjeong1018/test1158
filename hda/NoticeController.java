package com.newriver.hondakorea_bo.controller.bbs;

import com.newriver.hondakorea_bo.model.Notice;
import com.newriver.hondakorea_bo.model.SearchDTO;
import com.newriver.hondakorea_bo.paging.PagingResponse;
import com.newriver.hondakorea_bo.service.NoticeService;
import lombok.extern.log4j.Log4j2;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;

import java.util.List;

@Controller
@Log4j2
public class NoticeController {

    @Autowired
    private NoticeService noticeService;

    @GetMapping("/bbs/noticeList")
    public String noticeList(@ModelAttribute("params") final SearchDTO params, Model model) {
        log.info("===> /bbs/noticeList params: "+ params.toString());

        PagingResponse<Notice> response = noticeService.getAllNotice(params);
        model.addAttribute("response", response);
        // log.info("response: "+ response);

        return "bbs/notice_list";
    }
}
