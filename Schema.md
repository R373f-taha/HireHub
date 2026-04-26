
================================================================================
                              HIREHUB DATABASE SCHEMA
================================================================================

┌─────────────────────────────────────────────────────────────────────────────┐
│ 1. COUNTRIES                                                                |
├─────────────────────────────────────────────────────────────────────────────┤
│ • id (PK)          - bigint        🔑                                       │
│ • name             - string        🌍                                       │
│ • created_at       - timestamp     📅                                       │
│ • updated_at       - timestamp     📅                                       │
└─────────────────────────────────────────────────────────────────────────────┘
                                      │ 1
                                      │ has many
                                      │ o{
                                      ▼
┌─────────────────────────────────────────────────────────────────────────────┐
│ 2. CITIES                                                                   │
├─────────────────────────────────────────────────────────────────────────────┤
│ • id (PK)          - bigint        🔑                                       │
│ • name             - string        🏙️                                       │
│ • country_id (FK)  - bigint        → COUNTRIES.id                           │
│ • created_at       - timestamp     📅                                       │
│ • updated_at       - timestamp     📅                                       │
└─────────────────────────────────────────────────────────────────────────────┘
                                      │ 1
                                      │ has many
                                      │ o{
                                      ▼
┌─────────────────────────────────────────────────────────────────────────────┐
│ 3. USERS                                                                    | 
├─────────────────────────────────────────────────────────────────────────────┤
│ • id (PK)              - bigint        🔑                                   │
│ • name                 - string        👤                                   │
│ • email (UK)           - string        📧                                   │
│ • email_verified_at    - timestamp     ✅                                   │
│ • password             - string        🔒                                   │
│ • city_id (FK)         - bigint        → CITIES.id                           │
│ • role                 - enum          🎭 (client/freelancer/admin)         │
│ • remember_token       - string        🍪                                   │
│ • created_at           - timestamp     📅                                   │
│ • updated_at           - timestamp     📅                                   │
└─────────────────────────────────────────────────────────────────────────────┘
          │ 1                              │ 1
          │ is_a (one-to-one)              │ is_a (one-to-one)
          ▼                                ▼
┌────────────────────────────┐  ┌────────────────────────────────────────────┐
│ 4.       (clients)         │  │ 5. FREELANCERS                             │
├────────────────────────────┤  ├────────────────────────────────────────────┤
│ • id (PK)         - bigint │  │ • id (PK)           - bigint               │
│ • user_id (FK)    - bigint │  │ • user_id (FK)      - bigint               │
│ • location_info   - json   │  │ • is_verified       - boolean              │
│ • created_at      - ts     │  │ • location_info     - json                 │
│ • updated_at      - ts     │  │ • is_active         - boolean              │
└────────────────────────────┘  │ • created_at        - timestamp            │
          │ 1                   │ • updated_at        - timestamp            │
          │ has many            └────────────────────────────────────────────┘
          │ o{                                   
          ▼                                     
┌────────────────────────────────────────────────────────────────────────────┐
│ 6. PROJECTS                                    │ o{                         │
├────────────────────────────────────────────────┼────────────────────────────┤
│ • id (PK)              - bigint        🔑     │                            │
│ • title                - string        📌     │                            │
│ • description          - text          📄     │                            │
│ • type_of_balance      - enum          ⚖️     │                            │
│ • project_status       - enum          📊     │                            │
│ • budget               - json          💵     │                            │
│ • deadline             - date          ⏰     │                            │
│ • client_id (FK)       - bigint        → LIMBS.id                           │
│ • created_at           - timestamp     📅                                   │
│ • updated_at           - timestamp     📅                                   │
└─────────────────────────────────────────────────────────────────────────────┘
          │ 1                              │ 1                              │ 1
          │ has many                       │ has one                        │ belongs to many
          │ o{                             │ ||                             │ o{
          ▼                                ▼                               ▼
┌────────────────────────────┐  ┌────────────────────────────┐  ┌────────────────────────────┐
│ 7. OFFERS                  │  │ 8. REVIEWS                 │  │ 9. TAGS                    │
├────────────────────────────┤  ├────────────────────────────┤  ├────────────────────────────┤
│ • id (PK)           bigint │  │ • id (PK)           bigint │  │ • id (PK)           bigint │
│ • project_id (FK)   bigint │  │ • project_id (FK)   bigint │  │ • name              string │
│ • freelancer_id(FK) bigint │  │ • freelancer_id(FK) bigint │  │ • created_at        ts     │
│ • proposed_amount   dec    │  │ • client_id (FK)    bigint │  │ • updated_at        ts     │
│ • submission_letter text   │  │ • comment           text   │  └────────────────────────────┘
│ • delivered_days    sint   │  │ • freelancer_rating int   │              │
│ • offer_status      enum   │  │ • project_rating    int   │              │ 1
│ • created_at        ts     │  │ • created_at        ts    │              │ belongs to many (many-to-many)
│ • updated_at        ts     │  │ • updated_at        ts    │              │ o{
└────────────────────────────┘  └────────────────────────────┘              ▼
                                                                  ┌────────────────────────────┐
                                                                  │ 10. PROJECT_TAG (Pivot)    │
                                                                  ├────────────────────────────┤
                                                                  │ • id (PK)           bigint │
                                                                  │ • tag_id (FK)       bigint │
                                                                  │ • project_id (FK)   bigint │
                                                                  └────────────────────────────┘

┌─────────────────────────────────────────────────────────────────────────────┐
│ 11. PROFILES (one-to-one with freelancers)                                  │
├─────────────────────────────────────────────────────────────────────────────┤
│ • id (PK)              - bigint        🔑                                   │
│ • bio                  - text          📝                                   │
│ • first_name           - string        👨                                   │
│ • last_name            - string        👨                                   │
│ • image                - string        🖼️                                   │
│ • protofilo_link       - string        🔗                                   │
│ • hour_rate            - decimal       💰                                   │
│ • phone                - string        📞                                   │
│ • skills_summery       - json          📊                                   │
│ • available_mode       - enum          ⚡ (available/not available/busy)    │
│ • freelancer_id (FK)   - bigint        → FREELANCERS.id (unique)            │
│ • created_at           - timestamp     📅                                   │
│ • updated_at           - timestamp     📅                                   │
└─────────────────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────────────────┐
│ 12. SKILLS                                                                  │
├─────────────────────────────────────────────────────────────────────────────┤
│ • id (PK)          - bigint        🔑                                       │
│ • skill_name       - string        🎯                                       │
│ • created_at       - timestamp     📅                                       │
│ • updated_at       - timestamp     📅                                       │
└─────────────────────────────────────────────────────────────────────────────┘
                                      │ 1
                                      │ belongs to many (many-to-many)
                                      │ o{
                                      ▼
┌─────────────────────────────────────────────────────────────────────────────┐
│ 13. FREELANCER_SKILL (Pivot with extra data)                                │
├─────────────────────────────────────────────────────────────────────────────┤
│ • id (PK)              - bigint        🔑                                   │
│ • years_of_experience  - int           ⏱️                                   │
│ • freelancer_id (FK)   - bigint        → FREELANCERS.id                     │
│ • skill_id (FK)        - bigint        → SKILLS.id                          │
└─────────────────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────────────────┐
│ 14. ATTACHMENTS (Polymorphic)                                               │
├─────────────────────────────────────────────────────────────────────────────┤
│ • id (PK)          - bigint        🔑                                       │
│ • file_name        - string        📎                                       │
│ • file_path        - string        📁                                       │
│ • attachable_id    - bigint        🔗                                       │
│ • attachable_type  - string        📂                                       │
│ • created_at       - timestamp     📅                                       │
│ • updated_at       - timestamp     📅                                       │
└─────────────────────────────────────────────────────────────────────────────┘
                    │                              │
                    │ belongs to (polymorphic)     │
                    ▼                              ▼
              ┌────────────┐                  ┌────────────┐
              │  PROJECTS  │                  │ FREELANCERS│
              └────────────┘                  └────────────┘
                    │                              │
                    ▼                              ▼
              ┌────────────┐                  ┌────────────┐
              │   OFFERS   │                  │  PROFILES  │
              └────────────┘                  └────────────┘



================================================================================
                          RELATIONSHIPS SUMMARY
================================================================================

┌─────────────────────┬──────────────────────────┬─────────────────────────────┐
│ الجدول المصدر       │ العلاقة                  │ الجدول الهدف               │
├─────────────────────┼──────────────────────────┼─────────────────────────────┤
│ countries           │ 1 ────────────────────────∞ │ cities                     │
│ cities              │ 1 ────────────────────────∞ │ users                      │
│ users               │ 1 ────────────────────────1 │ clients                    │
│ users               │ 1 ────────────────────────1 │ freelancers                │
│ freelancers         │ 1 ────────────────────────1 │ profiles                   │
│ freelancers         │ ∞ ────────────────────────∞ │ skills (via freelancer_skill│
│ clients             │ 1 ────────────────────────∞ │ projects                   │
│ projects            │ 1 ────────────────────────∞ │ offers                     │
│ projects            │ 1 ────────────────────────1 │ reviews                    │
│ projects            │ ∞ ────────────────────────∞ │ tags (via project_tag)     │
│ freelancers         │ 1 ────────────────────────∞ │ offers                     │
│ freelancers         │ 1 ────────────────────────∞ │ reviews                    │
│ clients             │ 1 ────────────────────────∞ │ reviews                    │
│ projects            │ 1 ────────────────────────∞ │ attachments (polymorphic)  │
│ freelancers         │ 1 ────────────────────────∞ │ attachments (polymorphic)  │
│ offers              │ 1 ────────────────────────∞ │ attachments (polymorphic)  │
│ profiles            │ 1 ────────────────────────∞ │ attachments (polymorphic)  │
│ users               │ 1 ────────────────────────∞ │ personal_access_tokens     │
└─────────────────────┴──────────────────────────┴─────────────────────────────┘

================================================================================
                              ENUM VALUES
================================================================================

┌─────────────────────┬───────────────────────────────────────────────────────┐
│ العمود              │     القيم المسموحة                                  │
├─────────────────────┼───────────────────────────────────────────────────────┤
│ users.role          │ 'admin', 'freelancer', 'client'                       │
│ projects.type_of_balance │ 'fixed', 'hourly'                                │
│ projects.project_status   │ 'open', 'in_progress', 'closed'                 │
│ offers.offer_status       │ 'accepted', 'rejected', 'pending'               │
│ profiles.available_mode   │ 'available', 'not available', 'busy'            │
└─────────────────────┴───────────────────────────────────────────────────────┘

================================================================================
                              INDEXES (Performance)
================================================================================

┌─────────────────────┬───────────────────────────────────────────────────────┐
│ الجدول              │            الفهارس                                   │
├─────────────────────┼───────────────────────────────────────────────────────┤
│ projects            │ project_status, client_id                            │
│ offers              │ project_id, freelancer_id ,offer_status              │
│ reviews             │ project_id, freelancer_id, client_id                 │
│ users               │ email (unique)                                       │
│ freelancers         │ user_id (unique)                                     │
│ clients             │ user_id (unique)                                     │
│ profiles            │ freelancer_id (unique)                               │
└─────────────────────┴───────────────────────────────────────────────────────┘
